<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/04/2018
 * Time: 16:44
 */

namespace App\UI\Action;

use App\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Action\Interfaces\TrickDetailsActionInterface;
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

        $trick = $this->trickRepository->getTrickBySlug($request->attributes->get('slug'));

        $videos = $trick->getVideo()->toArray();

        foreach ($videos as $video) {
            $vidType = strtolower($video->getVidType());

            $vidId = $video->getVidId();
            $video->setLink('src="https://www.'
                .$vidType.'.com/embed/video/'
                .$vidId);
        }

        //dd($trick->getVideo()->toArray());
        return $responder($trick);
    }
}
