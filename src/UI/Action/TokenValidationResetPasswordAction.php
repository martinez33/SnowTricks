<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 07/08/2018
 * Time: 00:26
 */

namespace App\UI\Action;


use App\Helper\EmailGenerator;
use App\Helper\TokenGenerator;
use App\Repository\UserRepository;
use App\UI\Responder\InvalidTokenResponder;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class TokenValidationResetPasswordAction
 * @package App\UI\Action
 *
 * @Route (path="/validation_res/{token}",
 *         name="validation_token_reset_password")
 */
class TokenValidationResetPasswordAction
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var TokenGenerator
     */
    private $tokenGenerator;

    /**
     * @var EmailGenerator
     */
    private $emailGenerator;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * TokenValidationRegister constructor.
     * @param Environment $twig
     * @param UserRepository $userRepository
     * @param UrlGeneratorInterface $urlGenerator
     * @param TokenGenerator $tokenGenerator
     * @param EmailGenerator $emailGenerator
     * @param \Swift_Mailer $mailer
     */
    public function __construct(
        Environment $twig,
        UserRepository $userRepository,
        UrlGeneratorInterface $urlGenerator,
        TokenGenerator $tokenGenerator,
        EmailGenerator $emailGenerator,
        \Swift_Mailer $mailer

    ) {
        $this->twig = $twig;
        $this->userRepository = $userRepository;
        $this->urlGenerator = $urlGenerator;
        $this->tokenGenerator = $tokenGenerator;
        $this->emailGenerator = $emailGenerator;
        $this->mailer = $mailer;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, InvalidTokenResponder $responder)
    {
        $token = $request->attributes->get('token');

        $user = $this->userRepository->getUserByTokenResetPassword($token);

        $sendedTime = $user->getTokenGeneratedTime();

        //$validTime = (24*3600);
        $validTime = (3*60);

        $limitTime = ($sendedTime+$validTime);//tps max de vie du token

        if (time() > $limitTime) {

            $cle = $this->tokenGenerator->tokenMaker(60);

            $user->setTokenRegistration($cle);
            $user->setTokenGeneratedTime(time());

            $this->userRepository->updateUser();

            $message = $this->emailGenerator->emailMaker($user->getUsername(),$user->getEmail(), $cle, 'emails/emailForgotPassword.html.twig');
            $this->mailer->send($message);

            return $responder($user->getEmail());
        } else {

            //$user->setTokenRegistration(null);

            $this->userRepository->updateUser();

            //$redirect = new RedirectResponse($this->urlGenerator->generate('reset_password', ['token' => $user->getTokenResetPassword()]));

            //appel de' la vue du formulair reset password

            return $redirect;
        }
    }
}