<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 30/04/2018
 * Time: 09:40
 */

namespace App\UI\Action;

use App\Domain\Interfaces\TrickInterface;
use App\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Action\Interfaces\DelTrickActionInterface;

use App\UI\Responder\Interfaces\DelTrickResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DelTrickAction
 *
 * @package App\UI\Action
 *
 * @Route(
 *     path="/delete/{slug}",
 *     name="trick_delete"
 *     )
 */
class DelTrickAction implements DelTrickActionInterface
{
    /**
     * @var TrickRepositoryInterface
     */
    private $trickRepository;

    /**
     * @var TrickInterface
     */
    private $trick;

    /**
     * DelTrickAction constructor.
     *
     * @param TrickRepositoryInterface $trickRepository
     */
    public function __construct(TrickRepositoryInterface $trickRepository)
    {
        $this->trickRepository = $trickRepository;
    }

    /**
     * @param Request $request
     * @param DelTrickResponderInterface $responder
     * @param SessionInterface $session
     * @return mixed
     */
    public function __invoke(
        Request $request,
        DelTrickResponderInterface $responder,
        SessionInterface $session//dans construct
    ) {

        $trick = $this->trickRepository->getTrickBySlug($request->attributes->get('slug'));

        $this->trickRepository->delTrickBySlug($trick);

        /*if ($result == 1) {*/
            $session->getFlashBag()->add('notice', 'Successfull : Trick removed !');

            return $responder();
        //}
    }
}
