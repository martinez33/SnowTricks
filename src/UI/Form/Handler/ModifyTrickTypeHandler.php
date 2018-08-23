<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 30/04/2018
 * Time: 14:32
 */

namespace App\UI\Form\Handler;

use App\Domain\Builder\Interfaces\ImageBuilderInterface;
use App\Domain\Builder\Interfaces\TrickBuilderInterface;
use App\Domain\Builder\Interfaces\VideoBuilderInterface;
use App\Domain\Image;
use App\Domain\Video;
use App\Helper\FileUpLoader;
use App\Helper\Interfaces\FindUrlInterface;
use App\Helper\Interfaces\SlugInterface;
use App\Helper\Interfaces\UniqueTrickNameInterface;
use App\Repository\Interfaces\ImageRepositoryInterface;
use App\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Form\Handler\Interfaces\ModifyTrickTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ModifyTrickTypeHandler implements ModifyTrickTypeHandlerInterface
{
    /**
     * @var FileUpLoader
     */
    private $fileUpLoader;

    /**
     * @var FindUrlInterface
     */
    private $findUrl;

    /**
     * @var ImageBuilderInterface
     */
    private $imageBuilder;

    /**
     * @var string
     */
    private $imageUploadFolder;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var SlugInterface
     */
    private $slug;

    /**
     * @var TrickBuilderInterface
     */
    private $trickBuilder;

    /**
     * @var TrickRepositoryInterface
     */
    private $trickRepository;

    /**
     * @var VideoBuilderInterface
     */
    private $videoBuilder;

    private $imageRepository;

    /**
     * AddTrickTypeHandler constructor.
     *
     * @param FileUpLoader $fileUpLoader
     * @param FindUrlInterface $findUrl
     * @param ImageBuilderInterface $imageBuilder
     * @param string $imageUploadFolder
     * @param SessionInterface $session
     * @param SlugInterface $slug
     * @param TrickBuilderInterface $trickBuilder
     * @param TrickRepositoryInterface $trickRepository
     * @param UniqueTrickNameInterface $uniqueTrickName
     * @param VideoBuilderInterface $videoBuilder
     */
    public function __construct(
        FileUpLoader $fileUpLoader,
        FindUrlInterface $findUrl,
        ImageBuilderInterface $imageBuilder,
        string $imageUploadFolder,
        SessionInterface $session,
        SlugInterface $slug,
        TrickBuilderInterface $trickBuilder,
        ImageRepositoryInterface $imageRepository,
        TrickRepositoryInterface $trickRepository,
        VideoBuilderInterface $videoBuilder
    ) {
        $this->fileUpLoader = $fileUpLoader;
        $this->findUrl = $findUrl;
        $this->imageBuilder = $imageBuilder;
        $this->imageUploadFolder = $imageUploadFolder;
        $this->session = $session;
        $this->slug = $slug;
        $this->trickBuilder = $trickBuilder;
        $this->trickRepository = $trickRepository;
        $this->imageRepository = $imageRepository;
        $this->videoBuilder = $videoBuilder;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form, Request $request): bool
    {

        if ($form->isSubmitted() && $form->isValid()) {

            $slug = $request->get('slug');

            $trick = $this->trickRepository->getTrickBySlug($slug);


            $images = $form->getData()['image'];


            foreach ($images as $cle => $tab) {

                $fileName = $this->fileUpLoader->upLoadImg($tab['image']);


                $res = $request->files->get('modify_trick')['image'];

                foreach ($res as $ext) {

                    $images = new Image($ext['image']->getClientOriginalExtension(),
                        $this->imageUploadFolder . $fileName);
                }

                $images->setTrick($trick);

                $tabImg[] = $images;
            }

            $videos = $form->getData()['video'];

            foreach ($videos as $video) {

                dump($video['video']);
                $str = $video['video'];

                $vidType = $this->findUrl->SearchVideoType($str);
                $vidId = $this->findUrl->FindVideoId($str, $vidType);

                $videos = new Video($vidId, $vidType);

                $videos->setTrick($trick);

                $tabVid[] = $videos;
                dump($tabVid);
            }

            $trick->update($form->getData()['description'], $form->getData()['grp'], $tabImg, $tabVid);

            $this->trickRepository->update();
            //$this->trickRepository->save($trick);

            return true;
        }

        return false;
    }
}
