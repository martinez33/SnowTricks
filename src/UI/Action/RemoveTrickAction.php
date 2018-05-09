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
use App\UI\Action\Interfaces\RemoveTrickActionInterface;

use App\UI\Responder\Interfaces\RemoveTrickResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RemoveTrickAction
 *
 * @package App\UI\Action
 *
 * @Route(
 *     path="/delete/{slug}",
 *     name="trick_delete"
 *     )
 */
class RemoveTrickAction implements RemoveTrickActionInterface
{
    /**
     * @var TrickRepositoryInterface
     */
    private $trickRepository;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * RemoveTrickAction constructor.
     *
     * @param TrickRepositoryInterface $trickRepository
     */
    public function __construct(SessionInterface $session, TrickRepositoryInterface $trickRepository)
    {
        $this->session = $session;
        $this->trickRepository = $trickRepository;
    }

    /**
     * @param Request $request
     * @param RemoveTrickResponderInterface $responder
     * @param SessionInterface $session
     * @return mixed
     */
    public function __invoke(
        Request $request,
        RemoveTrickResponderInterface $responder
    ) {

        $trick = $this->trickRepository->getTrickBySlug($request->attributes->get('slug'));

        $result = $this->trickRepository->delTrickBySlug($trick);

       if ($result == null ) {
            $this->session->getFlashBag()->add('notice', 'Successfull : Trick removed !');
       } else {
           $this->session->getFlashBag()->add('notice', 'Error : Remove Impossible !');
       }
        return $responder();
    }
}
