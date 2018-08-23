<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/07/2018
 * Time: 16:33
 */

namespace App\UI\Form\Handler;


use App\Domain\Builder\Interfaces\UserBuilderInterface;
use App\Domain\Builder\UserBuilder;
use App\Domain\User;
use App\Event\UserRegistrationEvent;
use App\Helper\EmailGenerator;
use App\Helper\TokenGenerator;
use App\Repository\UserRepository;
use App\UI\Form\Type\RegistrationType;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Twig\Environment;

class RegistrationTypeHandler
{
    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @var UserBuilder
     */
    private $userBuilder;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

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
     * @var Environment
     */
    private $twig;

    /**
     * RegistrationTypeHandler constructor.
     * @param SessionInterface $session
     * @param UserRepository $userRepository
     * @param EncoderFactoryInterface $encoderFactory
     * @param UserBuilder $userBuilder
     * @param ValidatorInterface $validator
     * @param EventDispatcherInterface $eventDispatcher
     * @param TokenGenerator $tokenGenerator
     * @param EmailGenerator $emailGenerator
     * @param \Swift_Mailer $mailer
     * @param Environment $twig
     */
    public function __construct(
        SessionInterface $session,
        UserRepository $userRepository,
        EncoderFactoryInterface $encoderFactory,
        UserBuilder $userBuilder,
        ValidatorInterface $validator,
        EventDispatcherInterface $eventDispatcher,
        TokenGenerator $tokenGenerator,
        EmailGenerator $emailGenerator,
        \Swift_Mailer $mailer,
        Environment $twig
    ) {
        $this->session = $session;
        $this->userRepository = $userRepository;
        $this->encoderFactory = $encoderFactory;
        $this->userBuilder = $userBuilder;
        $this->validator = $validator;
        $this->eventDispatcher = $eventDispatcher;
        $this->tokenGenerator = $tokenGenerator;
        $this->emailGenerator = $emailGenerator;
        $this->mailer = $mailer;
        $this->twig = $twig;
    }


    /**
     * @param FormInterface $form
     * @param Request $request
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function handle(FormInterface $form, Request $request): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $encoder = $this->encoderFactory->getEncoder(User::class);

            $this->userBuilder->createUserRegistration(
                $form->get('username')->getData(),
                $form->get('email')->getData(),
                $form->get('password')->getData(),
                \Closure::fromCallable([$encoder, 'encodePassword'])
            );

            $user = $this->userBuilder->getUser();
            $cle = $this->tokenGenerator->tokenMaker(60);

            //$roles = 'ROLE_ADMIN';

            //$user->setRoles($roles);
            $user->setTokenRegistration($cle);
            $user->setTokenGeneratedTime(time());

            $emailView = 'emails/emailRegistration.html.twig';

            $message = $this->emailGenerator->emailMaker($user->getUsername(), $user->getEmail(), $cle, $emailView);

            $this->emailGenerator->sendEmail($message);
            //$this->mailer->send($message);

            $this->userRepository->save($user);

            return true;
        }
        return false;
    }
}