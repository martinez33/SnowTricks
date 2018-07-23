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
use App\Helper\TokenGenerator;
use App\Repository\UserRepository;
use App\UI\Form\Type\RegistrationType;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
     * RegistrationTypeHandler constructor.
     * @param SessionInterface $session
     * @param UserRepository $userRepository
     * @param EncoderFactoryInterface $encoderFactory
     * @param UserBuilder $userBuilder
     * @param ValidatorInterface $validator
     * @param EventDispatcherInterface $eventDispatcher
     * @param TokenGenerator $tokenGenerator
     */
    public function __construct(
        SessionInterface $session,
        UserRepository $userRepository,
        EncoderFactoryInterface $encoderFactory,
        UserBuilder $userBuilder,
        ValidatorInterface $validator,
        EventDispatcherInterface $eventDispatcher,
        TokenGenerator $tokenGenerator
    ) {
        $this->session = $session;
        $this->userRepository = $userRepository;
        $this->encoderFactory = $encoderFactory;
        $this->userBuilder = $userBuilder;
        $this->validator = $validator;
        $this->eventDispatcher = $eventDispatcher;
        $this->tokenGenerator = $tokenGenerator;
    }


    /**
     * @param FormInterface $form
     * @param Request $request
     * @param User $user
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     */
    public function handle(FormInterface $form, Request $request): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {

            dump($form->get('username')->getData());

            $encoder = $this->encoderFactory->getEncoder(User::class);


            $this->userBuilder->createUserRegistration(
                $form->get('username')->getData(),
                $form->get('email')->getData(),
                $form->get('password')->getData(),
                \Closure::fromCallable([$encoder, 'encodePassword'])
            );

            $user = $this->userBuilder->getUser();
            $cle = $this->tokenGenerator->tokenMaker(60);

            $roles = 'ROLE_ADMIN';

            $user->setRoles($roles);
            $user->setTokenRegistration($cle);

            dump($user);
            //die;
           /* $event = new UserRegistrationEvent($user);
            dump($event);
            $this->eventDispatcher->dispatch(UserRegistrationEvent::NAME, $event);

            /*$errors = $this->validator->validate($form->getData(), null, array('creation'));

            if(count($errors) > 0) {
                $max = count($errors);

                for ($i=0; $i<$max; $i++) {

                    $this->session->getFlashBag()->add('form_notice', $errors[$i]->getMessage());
                }

                return false;
            }*/

            /*$user = $form->getData(); //hydratation du trick avec les données du DTO
            dump($user);*/
            $this->userRepository->save($user);


            return true;
        }
        return false;
    }
}