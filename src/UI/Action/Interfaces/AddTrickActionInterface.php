<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 11/04/2018
 * Time: 16:16
 */

namespace App\UI\Action\Interfaces;


use App\UI\Form\Handler\Interfaces\AddTrickTypeHandlerInterface;
use App\UI\Responder\Interfaces\AddTrickResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

interface AddTrickActionInterface
{
    public function __construct(
        FormFactoryInterface $formFactory,
        AddTrickTypeHandlerInterface $addTrickTypeHandler
    );

    public function __invoke(AddTrickResponderInterface $addTrickResponder, Request $request, SessionInterface $session);
}
