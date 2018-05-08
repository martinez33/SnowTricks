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
            $dataName = $form->getData()->name;

            $slug = $request->get('slug');

            //if ($this->uniqueTrickName->isUniqueName($dataName)) {


                /*$data = $this->trickRepository->findNameExist($dataName); //voir plutot contrainte au niveau du Type

                 if ($data != null) {
                     $this->session
                         ->getFlashBag()
                         ->add(
                             'note',
                             'The Trick is already exist !'
                         )
                     ;
                 } */
                $res = $this->slug->slug($form->getData()->name);

                $trick = $this->trickBuilder->create(
                    $form->getData()->name,
                    $form->getData()->description,
                    $form->getData()->grp,
                    $res
                );

                /*$this->trickRepository->modifyTrick(
                    $slug,
                    $form->getData()->name,
                    $form->getData()->description,
                    $form->getData()->grp,
                    $res,
                    time()
                );*/



                $file = $form->getData()->image; //renvoie du tab image

                $maxImg = count($file);

                for ($i = 0; $i < $maxImg; $i++) {
                    $pict = $form->getData()->image[$i];

                    $fileName = $this->fileUpLoader->upLoadImg($pict['image']);


                    $this->imageBuilder->create(
                        $this->imageUploadFolder . $fileName,
                        $request
                            ->files
                            ->get('add_trick')['image'][$i]['image']
                            . 'jpg',
                        $this->trickBuilder->getTrick()
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
                    $this->trickBuilder->getTrick()
                );

                    $this->trickRepository->save($this->videoBuilder->getVideo());
                }
                return true;
            }

        return false;
    }
}
