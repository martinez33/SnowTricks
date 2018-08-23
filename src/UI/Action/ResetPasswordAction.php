<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 07/08/2018
 * Time: 01:33
 */

namespace App\UI\Action;


use App\Helper\TokenValidator;
use App\Repository\UserRepository;
use App\UI\Form\Handler\ResetPasswordTypeHandler;
use App\UI\Form\Type\ResetPasswordType;
use App\UI\Responder\ResetPasswordResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ResetPasswordAction
 * @package App\UI\Action
 *
 * @Route( path="/reset_password/{token}",
 *     name="reset_password")
 */
class ResetPasswordAction
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var ResetPasswordTypeHandler
     */
    private $resetPasswordTypeHandler;

    /**
     * @var TokenValidator
     */
    private $validationToken;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * ResetPasswordAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param ResetPasswordTypeHandler $resetPasswordTypeHandler
     * @param TokenValidator $validationToken
     * @param UserRepository $userRepository
     * @param UrlGeneratorInterface $urlGenerator
     * @param SessionInterface $session
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        ResetPasswordTypeHandler $resetPasswordTypeHandler,
        TokenValidator $validationToken,
        UserRepository $userRepository,
        UrlGeneratorInterface $urlGenerator,
        SessionInterface $session
    ) {
        $this->formFactory = $formFactory;
        $this->resetPasswordTypeHandler = $resetPasswordTypeHandler;
        $this->validationToken = $validationToken;
        $this->userRepository = $userRepository;
        $this->urlGenerator = $urlGenerator;
        $this->session = $session;
    }


    /**
     * @param ResetPasswordResponder $responder
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        ResetPasswordResponder $responder,
        Request $request
    ) {
        $resetPasswordType = $this->formFactory->create(ResetPasswordType::class)->handleRequest($request);
        $user = $this->userRepository->getUserByTokenResetPassword($request->get('token'));

        if ($user === null) {
            $this->session->getFlashBag()->add('notice', 'Mail non valide !');

            return $responder($resetPasswordType, true);

        } elseif ($this->resetPasswordTypeHandler->handle($resetPasswordType, $user)) {
            $this->session->getFlashBag()->add('notice', 'Mot de passe réinitialisé !');

            return $responder($resetPasswordType, true);

        } else {
            $email = 'emails/emailForgotPassword.html.twig';
            $validToken = $this->validationToken->validationToken($request->get('token'), false, $email);

            if ($validToken === true && $user !== null) {

                return $responder($resetPasswordType, false);

            } else {
                $this->session->getFlashBag()->add('notice', 'Le mail de confirmation est expiré ! Un nouveau mail de confirmation vient de vous être envoyé !');

                return $responder($resetPasswordType, true);
            }
        }
    }
}