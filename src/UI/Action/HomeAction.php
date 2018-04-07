<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 29/03/2018
 * Time: 01:44.
 */

namespace App\UI\Action;

use App\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Action\Interfaces\HomeActionInterface;
use App\UI\Responder\Interfaces\HomeResponderInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeAction.
 *
 * @Route(
 *     path="/snowtricks/{_locale}"
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
     * @param string                   $imageFolder
     * @param TrickRepositoryInterface $trickRepository
     * @param array                    $data
     */
    public function __construct(
        string $imageFolder,
        TrickRepositoryInterface $trickRepository,
        array $data = []
    ) {
        $this->imageFolder = $imageFolder;
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

        if (!empty($data)) {
            return $responder($data);
        } else {
            throw new \Exception('Invalid Datas !');
        }
    }
}
