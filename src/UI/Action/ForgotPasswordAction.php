<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 06/08/2018
 * Time: 15:10
 */

namespace App\UI\Action;


use App\UI\Action\Interfaces\ForgotPasswordActionInterface;
use App\UI\Form\Handler\ForgotPasswordTypeHandler;
use App\UI\Form\Type\ForgotPasswordType;
use App\UI\Responder\ForgotPasswordResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ForgotPasswordAction
 * @package App\UI\Action
 *
 * @Route( path="/forgot_password",
 *         name="forgot_password")
 */
class ForgotPasswordAction implements ForgotPasswordActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var ForgotPasswordTypeHandler
     */
    private $forgotPasswordTypeHandler;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * ForgotPasswordAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param ForgotPasswordTypeHandler $forgotPasswordTypeHandler
     * @param SessionInterface $session
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        ForgotPasswordTypeHandler $forgotPasswordTypeHandler,
        SessionInterface $session
    ) {
        $this->formFactory = $formFactory;
        $this->forgotPasswordTypeHandler = $forgotPasswordTypeHandler;
        $this->session = $session;
    }


    /**
     * @param ForgotPasswordResponder $responder
     * @param Request $request
     * @return string
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(ForgotPasswordResponder $responder, Request $request)
    {
        $forgotPasswordType = $this->formFactory->create(ForgotPasswordType::class)->handleRequest($request);

        if ($this->forgotPasswordTypeHandler->handle($forgotPasswordType, $request)) {
            $this->session->getFlashBag()->add('notice', 'Un mail vous permetant de réinitialiser votre mot de passe vient de vous être envoyé !');

            return $responder($forgotPasswordType, true);
        } else {
            return $responder($forgotPasswordType,false);
        }
    }
}