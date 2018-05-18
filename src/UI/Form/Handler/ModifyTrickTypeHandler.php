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
     * @var UniqueTrickNameInterface
     */
    private $uniqueTrickName;

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
        UniqueTrickNameInterface $uniqueTrickName,
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
        $this->uniqueTrickName = $uniqueTrickName;
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

            $temp = $this->trickRepository->getTrickBySlug($slug);
            $trick = $this->trickRepository->test($temp->getId());

            $trick->setUpdated(time());
            $trick->setDescription($form->getData()->description);
            $trick->setGrp($form->getData()->grp);

            $file = $form->getData()->image; //renvoie du tab image

            $maxImg = count($file);

            for ($i = 0; $i < $maxImg; $i++) {
                $pict = $form->getData()->image[$i];

                $fileName = $this->fileUpLoader->upLoadImg($pict['image']);

                $first = false;

                $this->imageBuilder->create(
                    $request->files->get('add_trick')['image'][$i]['image'] . 'jpg',
                    $this->imageUploadFolder . $fileName,
                    $first,
                    $trick
                );

                $this->trickRepository->save($this->imageBuilder->getImage());
            }

            $video = $form->getData()->video;
            $maxVideo = count($video);

            for ($i = 0; $i < $maxVideo; $i++) {

                $str = $form->getData()->video[$i]['video'];
                $vidType = $this->findUrl->SearchVideoType($str);
                $vidId = $this->findUrl->FindVideoId($str, $vidType);

                $this->videoBuilder->create(
                    $vidId,
                    $vidType,
                    $trick
                );

                $this->trickRepository->save($this->videoBuilder->getVideo());
            }

            $this->trickRepository->update();
           // $this->trickRepository->save($trick);

            return true;
        }

        return false;
    }
}
