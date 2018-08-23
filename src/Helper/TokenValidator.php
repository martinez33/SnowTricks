<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 07/08/2018
 * Time: 12:43
 */

namespace App\Helper;


use App\Domain\User;
use App\Repository\UserRepository;
use phpDocumentor\Reflection\Types\Nullable;

class TokenValidator
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
     * @var EmailGenerator
     */
    private $emailGenerator;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * TokenValidator constructor.
     * @param UserRepository $userRepository
     * @param TokenGenerator $tokenGenerator
     * @param EmailGenerator $emailGenerator
     * @param \Swift_Mailer $mailer
     */
    public function __construct(
        UserRepository $userRepository,
        TokenGenerator $tokenGenerator,
        EmailGenerator $emailGenerator,
        \Swift_Mailer $mailer
    ) {
        $this->userRepository = $userRepository;
        $this->tokenGenerator = $tokenGenerator;
        $this->emailGenerator = $emailGenerator;
        $this->mailer = $mailer;
    }

    /**
     * @param string $token
     * @param bool $registration
     * @param bool $resetPassword
     * @param string $email
     * @return bool
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function validationToken(
        string $token,
        bool $registration,
        string $email
    ) {
        $registration
            ? $user = $this->userRepository->getUserByTokenRegister($token)
            : $user = $this->userRepository->getUserByTokenResetPassword($token);

        //dump($token);
        //dump($user);die;

        $sendedTime = $user->getTokenGeneratedTime();

         $validTime = (24*3600);
         //$validTime = (10);

        $limitTime = ($sendedTime+$validTime);//tps max de vie du token

        if (time() > $limitTime) {
            $cle = $this->tokenGenerator->tokenMaker(60);

            $registration
                ? $user->setRegistration($cle, time(), null)
                : $user->setResetPassword($cle, time());

            $message = $this->emailGenerator->emailMaker($user->getUsername(),$user->getEmail(), $cle, $email);
            //$this->mailer->send($message);

            $this->emailGenerator->sendEmail($message);

            $this->userRepository->updateUser();

            return false;

        } else {
            /*$registration
                ?*/ $user->setRegistration(null, time(), time());
                //: $user->setResetPassword(, time());


            $this->userRepository->updateUser();

            return true;
        }
    }
}