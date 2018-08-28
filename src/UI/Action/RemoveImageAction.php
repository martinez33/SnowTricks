<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 25/08/2018
 * Time: 20:37
 */

namespace App\UI\Action;

use App\Repository\ImageRepository;
use App\Repository\Interfaces\ImageRepositoryInterface;
use App\UI\Responder\RemoveImageResponder;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RemoveImageAction
 *
 * @package App\UI\Action
 *
 * @Route(
 *     path="/delete/image/{id}",
 *     name="delete_image"
 * )
 */
class RemoveImageAction
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
     * @param Request $request
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function __invoke(Request $request, RemoveImageResponder $responder)
    {
        $image = $this->imageRepository->findImageById($request->get('id'));

        $slug = $image->getTrick()->getSlug();
        //dump($slug);
        //die;

        $this->imageRepository->removeImage($image);

        $this->fileSystem->remove($this->publicDirectory.$image->getFileName());

        return $responder($slug);
    }
}