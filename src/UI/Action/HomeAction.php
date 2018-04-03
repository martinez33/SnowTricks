<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 29/03/2018
 * Time: 01:44
 */

namespace App\UI\Action;

use App\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Action\Interfaces\HomeActionInterface;
use App\UI\Responder\Interfaces\HomeResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeAction
 *
 * @package App\UI\Action
 * @Route(
 *     path="/"
 * )
 */
class HomeAction implements HomeActionInterface
{
    /**
     * @var string
     */
    private $imageFolder;

    /**
     * @var TrickRepositoryInterface
     */
    private $trickRepository;


    /**
     * HomeAction constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(
        string $imageFolder,
        TrickRepositoryInterface $trickRepository,
        array $datas = []
    ) {
        $this->imageFolder = $imageFolder;
        $this->trickRepository = $trickRepository;
    }

    /**
     * @param HomeResponderInterface $responder
     * @return HomeResponderInterface
     */
    public function __invoke(HomeResponderInterface $responder)
    {
        $datas = $this->trickRepository->findAllTrick();

        return $responder($datas);
    }
}