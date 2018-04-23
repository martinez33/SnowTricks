<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/04/2018
 * Time: 16:44
 */

namespace App\UI\Action;

use App\Form\Handler\Interfaces\AddTrickTypeHandlerInterface;
use App\Repository\Interfaces\ImageRepositoryInterface;
use App\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Action\Interfaces\TrickDetailsActionInterface;

;
use App\UI\Responder\Interfaces\TrickDetailsResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TrickDetailsAction
 *
 * @package App\UI\Action
 *
 * @Route(
 *     path="/tricks/details/{slug}",
 *     name="trick_details"
 * )
 */
class TrickDetailsAction implements TrickDetailsActionInterface
{
    /**
     * @var TrickRepositoryInterface
     */
    private $trickRepository;


    /**
     * TrickDetailsAction constructor.
     *
     * @param TrickRepositoryInterface      $trickRepository
     * @param FormFactoryInterface          $formFactory
     * @param AddTrickTypeHandlerInterface  $addTrickTypeHandler
     */
    public function __construct(
        TrickRepositoryInterface $trickRepository
    ) {
        $this->trickRepository = $trickRepository;
    }

    /**
     * @param TrickDetailsResponderInterface $responder
     * @param Request $request
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function __invoke(
        TrickDetailsResponderInterface $responder,
        Request $request
    ) {
        $slug = $request->get('slug');

        $data = $this->trickRepository->findTrick($slug);

        $img = $this->trickRepository->findImgByTrick($slug);

        $video = $this->trickRepository->findVideoByTrick($slug);
        return $responder($data, $img, $video);
    }
}
