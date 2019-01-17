<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 30/04/2018
 * Time: 14:42
 */

namespace App\UI\Action\Interfaces;

use App\Domain\Factory\ModifyTrickDTOFactory;
use App\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Form\Handler\Interfaces\ModifyTrickTypeHandlerInterface;
use App\UI\Responder\Interfaces\ModifyTrickResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

interface ModifyTrickActionInterface
{
    public function __construct(
        FormFactoryInterface $formFactory,
        ModifyTrickTypeHandlerInterface $modifyTrickTypeHandler,
        TrickRepositoryInterface $trickRepository,
        \Symfony\Component\Security\Core\Security $security,
        SessionInterface $session,
        ModifyTrickDTOFactory $modifyTrickDTOFactory
    );

    /**
     * @param ModifyTrickResponderInterface $responder
     * @param Request $request
     * @param SessionInterface $session
     * @return mixed
     */
    public function __invoke(ModifyTrickResponderInterface $responder, Request $request, SessionInterface $session);
}
