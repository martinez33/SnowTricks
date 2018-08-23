<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 06/08/2018
 * Time: 15:30
 */

namespace App\UI\Form\Handler;


use App\Helper\EmailGenerator;
use App\Helper\TokenGenerator;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ForgotPasswordTypeHandler
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var TokenGenerator
     */
    private $tokenGenerator;

    /**
     * @var \Swift_Mailer
     */
    private $email;

    /**
     * @var EmailGenerator
     */
    private $emailGenerator;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * ForgotPasswordTypeHandler constructor.
     * @param UserRepository $userRepository
     * @param TokenGenerator $tokenGenerator
     * @param \Swift_Mailer $email
     * @param EmailGenerator $emailGenerator
     * @param SessionInterface $session
     */
    public function __construct(
        UserRepository $userRepository,
        TokenGenerator $tokenGenerator,
        \Swift_Mailer $email,
        EmailGenerator $emailGenerator,
        SessionInterface $session
    ) {
        $this->userRepository = $userRepository;
        $this->tokenGenerator = $tokenGenerator;
        $this->email = $email;
        $this->emailGenerator = $emailGenerator;
        $this->session = $session;
    }


    /**
     * @param FormInterface $form
     *
     * @param  Request $request
     * @return bool
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function handle(FormInterface $form, Request $request)
    {
        if ($form->isSubmitted() && $form->isValid()) {

            dump($form->get('username')->getData());

            $user = $this->userRepository->getUserByName($form->get('username')->getData());

            if ($user != null) {

                $cle = $this->tokenGenerator->tokenMaker(60);

                $user->setResetPassword($cle, time());

                $emailView = 'emails/emailForgotPassword.html.twig';

                $message = $this->emailGenerator->emailMaker($user->getUsername(), $user->getEmail(), $cle, $emailView);

                $this->email->send($message);

                $this->userRepository->updateUser();

                return true;
            } else {
                $this->session->getFlashBag()->add('notice', 'L\'utilisateur n\'existe pas !');
                return false;
            }


        }

        return false;
    }
}