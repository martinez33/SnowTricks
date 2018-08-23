<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 07/08/2018
 * Time: 02:10
 */

namespace App\UI\Form\Handler;



use App\Domain\Builder\UserBuilder;
use App\Domain\User;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ResetPasswordTypeHandler
{
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
     * ResetPasswordTypeHandler constructor.
     * @param UserRepository $userRepository
     * @param EncoderFactoryInterface $encoderFactory
     * @param UserBuilder $userBuilder
     */
    public function __construct(UserRepository $userRepository, EncoderFactoryInterface $encoderFactory, UserBuilder $userBuilder)
    {
        $this->userRepository = $userRepository;
        $this->encoderFactory = $encoderFactory;
        $this->userBuilder = $userBuilder;
    }

    /**
     * @param FormInterface $form
     * @param Request $request
     * @return bool
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(FormInterface $form, User $user = null ): bool //UserInterface $user
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $encoder = $this->encoderFactory->getEncoder(User::class);

            $user->setPassword(\Closure::fromCallable([$encoder, 'encodePassword']), $form->get('password')->getData());

            $user->setResetPassword(null, time());

            $this->userRepository->updateUser();

            return true;
        }
        return false;
    }
}