<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 30/04/2018
 * Time: 14:43
 */

namespace App\UI\Action;

use App\UI\Action\Interfaces\ModifyTrickActionInterface;
use App\UI\Form\Handler\Interfaces\ModifyTrickTypeHandlerInterface;
use App\UI\Form\Handler\ModifyTrickTypeHandler;
use App\UI\Form\Type\Interfaces\ModifyTrickTypeInterface;
use App\UI\Form\Type\ModifyTrickType;
use App\UI\Responder\Interfaces\ModifyTrickResponderInterface;
use App\UI\Responder\ModifyTrickResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ModifyTrickAction
 *
 * @package App\UI\Action
 *
 * @Route(
 *     path="/tricks/update/{slug}",
 *     name="trick_modify"
 * )
 */
class ModifyTrickAction implements ModifyTrickActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var ModifyTrickTypeHandler
     */
    private $modifyTrickTypeHandler;

    /**
     * ModifyTrickAction constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param ModifyTrickTypeHandlerInterface $modifyTrickTypeHandler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        ModifyTrickTypeHandlerInterface $modifyTrickTypeHandler
    ) {
        $this->formFactory = $formFactory;
        $this->modifyTrickTypeHandler = $modifyTrickTypeHandler;
    }

    /**
     * @param ModifyTrickResponder $responder
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(ModifyTrickResponderInterface $responder, Request $request)
    {
        $modifyTrickType = $this->formFactory->create(ModifyTrickType::class)->handleRequest($request);

        if ($this->modifyTrickTypeHandler->handle($modifyTrickType, $request)) {
            return $responder(true);
        } else {
            return $responder(false, $modifyTrickType);
        }
    }
}