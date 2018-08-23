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

interface ModifyTrickActionInterface
{
    public function __construct(
        FormFactoryInterface $formFactory,
        ModifyTrickTypeHandlerInterface $modifyTrickTypeHandler,
        TrickRepositoryInterface $trickRepository,
        ModifyTrickDTOFactory $modifyTrickDTOFactory
    );

    public function __invoke(ModifyTrickResponderInterface $responder, Request $request);
}
