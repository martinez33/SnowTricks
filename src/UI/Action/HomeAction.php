<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 29/03/2018
 * Time: 01:44.
 */

namespace App\UI\Action;

use App\Domain\Comment;
use App\Domain\Image;
use App\Domain\Trick;
use App\Repository\Interfaces\ImageRepositoryInterface;
use App\Repository\Interfaces\TrickRepositoryInterface;
use App\Helper\Interfaces\SlugInterface;
use App\UI\Action\Interfaces\HomeActionInterface;
use App\UI\Responder\Interfaces\HomeResponderInterface;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeAction.
 *
 * @Route(
 *     path="/{_locale}/",
 *     name="home",
 *     defaults={
 *         "_locale": "%locale%"
 *     }
 * )
 */
class HomeAction implements HomeActionInterface
{
    /**
     * @var ImageRepositoryInterface
     */
    private $ImageRepository;

    /**
     * @var TrickRepositoryInterface
     */
    private $trickRepository;

    /**
     * HomeAction constructor.
     *
     * @param ImageRepositoryInterface  $imageRepository
     * @param TrickRepositoryInterface  $trickRepository
     */
    public function __construct(
        ImageRepositoryInterface $imageRepository,
        TrickRepositoryInterface $trickRepository
    ) {
        $this->ImageRepository = $imageRepository;
        $this->trickRepository = $trickRepository;
    }

    /**
     * @param HomeResponderInterface $responder
     *
     * @return HomeResponderInterface
     *
     * @throws \Exception
     */
    public function __invoke(HomeResponderInterface $responder)
    {
        $data = $this->trickRepository->findAllTrick();



        return $responder($data);
    }
}
