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
use App\Domain\Trick;
use App\Helper\FileUpLoader;
use App\Helper\Interfaces\FindUrlInterface;
use App\Helper\Interfaces\SlugInterface;
use App\Helper\Interfaces\UniqueTrickNameInterface;
use App\Helper\RemoveImage;
use App\Repository\Interfaces\ImageRepositoryInterface;
use App\Repository\Interfaces\TrickRepositoryInterface;
use App\Repository\Interfaces\VideoRepositoryInterface;
use App\UI\Form\Handler\Interfaces\ModifyTrickTypeHandlerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
     * @var string
     */
    private $imageUploadFolder;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var TrickRepositoryInterface
     */
    private $trickRepository;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var VideoBuilderInterface
     */
    private $videoBuilder;

    /**
     * @var ImageRepositoryInterface
     */
    private $imageRepository;

    /**
     * @var VideoRepositoryInterface;
     */
    private $videoRepository;

    /**
     * @var RemoveImage
     */
    private $removeImage;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @var string
     */
    private $publicDirectory;

    /**
     * ModifyTrickTypeHandler constructor.
     * @param FileUpLoader $fileUpLoader
     * @param FindUrlInterface $findUrl
     * @param string $imageUploadFolder
     * @param SessionInterface $session
     * @param TrickRepositoryInterface $trickRepository
     * @param ValidatorInterface $validator
     * @param VideoBuilderInterface $videoBuilder
     * @param ImageRepositoryInterface $imageRepository
     * @param VideoRepositoryInterface $videoRepository
     * @param RemoveImage $removeImage
     * @param Filesystem $fileSystem
     * @param string $publicDirectory
     */
    public function __construct(
        FileUpLoader $fileUpLoader,
        FindUrlInterface $findUrl,
        string $imageUploadFolder,
        SessionInterface $session,
        TrickRepositoryInterface $trickRepository,
        ValidatorInterface $validator,
        VideoBuilderInterface $videoBuilder,
        ImageRepositoryInterface $imageRepository,
        VideoRepositoryInterface $videoRepository,
        RemoveImage $removeImage,
        Filesystem $fileSystem,
        string $publicDirectory
    ) {
        $this->fileUpLoader = $fileUpLoader;
        $this->findUrl = $findUrl;
        $this->imageUploadFolder = $imageUploadFolder;
        $this->session = $session;
        $this->trickRepository = $trickRepository;
        $this->validator = $validator;
        $this->videoBuilder = $videoBuilder;
        $this->imageRepository = $imageRepository;
        $this->videoRepository = $videoRepository;
        $this->removeImage = $removeImage;
        $this->fileSystem = $fileSystem;
        $this->publicDirectory = $publicDirectory;
    }


    /**
     * @param FormInterface $form
     * @param Request $request
     * @param Trick $trick
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(FormInterface $form, Request $request, Trick $trick): bool
    {

        if ($form->isSubmitted() && $form->isValid()) {

            $difVideo = array_diff_key($trick->getVideo()->toArray(), $form['video']->getData());

            foreach ($difVideo as $cpt => $videoToRmv) {

                $trick->removeVideo($videoToRmv);
                $this->videoRepository->removeVideo($videoToRmv);
            }

            foreach ($form['video']->getData() as $key => $video) {

                $videoType = $this->findUrl->SearchVideoType($video->getLink());
                $videoId = $this->findUrl->FindVideoId($video->getLink(), $videoType);
                if ($videoId !== $video->getVidId()) {
                    dump($video);
                    $video->setVidType($videoType);
                    $video->setVidId($videoId);
                    $video->setUpdated(time());
                    $this->videoRepository->update();
                } else {
                    $video->setVidId($videoId);
                    $video->setVidType($videoType);
                }
            }

            $isModifImg = false;
            foreach ($form['image']->getData() as $keyImg => $img) {

                if ($img->getFileName() !== null && $img->getFile() instanceof UploadedFile) {
                    $tabImgToRmv[] = $img;
                    $isModifImg = true;
                }
            }
            if ($isModifImg) {
                foreach ($tabImgToRmv as $cpt => $imgToModif) {
                    $trick->removeImage($imgToModif);
                    $this->fileSystem->remove($this->publicDirectory.$imgToModif->getFileName());

                    $this->imageRepository->removeImage($imgToModif);
                }
            }

            $difImg = array_diff_key($trick->getImage()->toArray(), $form['image']->getData());

            foreach ($difImg as $cpt => $imgToRmv) {
                $trick->removeImage($imgToRmv);
                $this->fileSystem->remove($this->publicDirectory.$imgToRmv->getFileName());

                $this->imageRepository->removeImage($imgToRmv);
            }

            $tabImg = $form['image']->getData();

            foreach ($form['image']->getData() as $key => $img) {

                if ($img->getFile() instanceof UploadedFile) {
                    $file = $img->getFile();
                    $filename = $this->fileUpLoader->upLoadImg($file);
                    $img->setFilename($filename);
                    $img->setExt($file->getClientOriginalExtension());
                    $img->setFileName($this->imageUploadFolder . $filename);
                    $img->setStorageId($filename);
                    $img->setFirst(false);
                }
                $val = true;
                if ($img->isFirst() === true) {
                    $img->setFirst(false);
                }
            }
            $imgIsFirst = reset($tabImg);
            $imgIsFirst->setFirst(true);

            $trick->update($form->getData());

            $this->trickRepository->update();

            return true;
        }

        return false;
    }
}
