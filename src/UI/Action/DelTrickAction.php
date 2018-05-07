<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 30/04/2018
 * Time: 09:40
 */

namespace App\UI\Action;

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
        SessionInterface $session
    ) {
        $slug = $request->get('slug');

        $result = $this->trickRepository->delTrickBySlug($slug);

        if ($result == 1) {
            $session->getFlashBag()->add('notice', 'Successfull : Trick removed !');

            return $responder();
        }
    }
}
