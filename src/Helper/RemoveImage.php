<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 01/10/2018
 * Time: 23:38
 */

namespace App\Helper;


use App\Domain\Image;
use App\Repository\Interfaces\ImageRepositoryInterface;
use Symfony\Component\Filesystem\Filesystem;

class RemoveImage
{
    /**
     * @var ImageRepositoryInterface
     */
    private $imageRepository;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @var string
     */
    private $publicDirectory;

    /**
     * RemoveImageAction constructor.
     * @param ImageRepositoryInterface $imageRepository
     * @param Filesystem $fileSystem
     * @param string $publicDirectory
     */
    public function __construct(
        ImageRepositoryInterface $imageRepository,
        Filesystem $fileSystem,
        string $publicDirectory
    ) {
        $this->imageRepository = $imageRepository;
        $this->fileSystem = $fileSystem;
        $this->publicDirectory = $publicDirectory;
    }

    /**
     * @param Image $image
     */
    public function rmImgTrick(Image $image)
    {
        $img = $this->imageRepository->findImageById($image->getId());

        $this->imageRepository->removeImage($img);

        //$this->fileSystem->remove($this->publicDirectory.$image->getFileName());
    }

    /**
     * @param Image $image
     */
    public function rmImg(Image $image)
    {
        $img = $this->imageRepository->findImageById($image->getId());

        $this->imageRepository->removeImage($img);

        $this->fileSystem->remove($this->publicDirectory.$image->getFileName());
    }
}