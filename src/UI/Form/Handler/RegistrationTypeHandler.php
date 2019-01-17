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
use App\Domain\Image;
use App\Domain\User;
use App\Event\UserRegistrationEvent;
use App\Helper\EmailGenerator;
use App\Helper\FileUpLoader;
use App\Helper\TokenGenerator;
use App\Repository\Interfaces\ImageRepositoryInterface;
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
     * @var ImageRepositoryInterface
     */
    private $imageRepositoryInterface;

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
     * @var string
     */
    private $pictureUploadFolder;

    /**
     * @var FileUpLoader
     */
    private $fileUploader;

    /**
     * RegistrationTypeHandler constructor.
     * @param SessionInterface $session
     * @param UserRepository $userRepository
     * @param ImageRepositoryInterface $imageRepositoryInterface
     * @param EncoderFactoryInterface $encoderFactory
     * @param UserBuilder $userBuilder
     * @param ValidatorInterface $validator
     * @param EventDispatcherInterface $eventDispatcher
     * @param TokenGenerator $tokenGenerator
     * @param EmailGenerator $emailGenerator
     * @param \Swift_Mailer $mailer
     * @param Environment $twig
     * @param string $pictureUploadFolder
     * @param FileUpLoader $fileUploader
     */
    public function __construct(
        SessionInterface $session,
        UserRepository $userRepository,
        ImageRepositoryInterface $imageRepositoryInterface,
        EncoderFactoryInterface $encoderFactory,
        UserBuilder $userBuilder,
        ValidatorInterface $validator,
        EventDispatcherInterface $eventDispatcher,
        TokenGenerator $tokenGenerator,
        EmailGenerator $emailGenerator,
        \Swift_Mailer $mailer,
        Environment $twig,
        string $pictureUploadFolder,
        FileUpLoader $fileUploader
    ) {
        $this->session = $session;
        $this->userRepository = $userRepository;
        $this->imageRepositoryInterface = $imageRepositoryInterface;
        $this->encoderFactory = $encoderFactory;
        $this->userBuilder = $userBuilder;
        $this->validator = $validator;
        $this->eventDispatcher = $eventDispatcher;
        $this->tokenGenerator = $tokenGenerator;
        $this->emailGenerator = $emailGenerator;
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->pictureUploadFolder = $pictureUploadFolder;
        $this->fileUploader = $fileUploader;
    }


    /**
     * @param FormInterface $form
     * @param Request $request
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @throws \Exception
     */
    public function handle(FormInterface $form, Request $request): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {

            dump($form->getData());
            dump($form->getData()['picture']);

            $file = $form->getData()['picture'];
            $filename = $this->fileUploader->upLoadPict($file);

            $img = new Image();
            $img->setExt($file->getClientOriginalExtension());
            $img->setFileName($this->pictureUploadFolder.$filename);
            $img->setStorageId($filename);
            $img->setFirst(false);

            dump($img);

            //die();
            $encoder = $this->encoderFactory->getEncoder(User::class);

            $this->userBuilder->createUserRegistration(
                $img,
                $form->get('username')->getData(),
                $form->get('email')->getData(),
                $form->get('password')->getData(),
                \Closure::fromCallable([$encoder, 'encodePassword'])
            );

            $user = $this->userBuilder->getUser();

            dump($user);
           // die;
            $img->setUser($user);

            $cle = $this->tokenGenerator->tokenMaker(60);

            //$roles = 'ROLE_ADMIN';

            //$user->setRoles($roles);
            $user->setTokenRegistration($cle);
            $user->setTokenGeneratedTime(time());

            $emailView = 'emails/emailRegistration.html.twig';

            $message = $this->emailGenerator->emailMaker($user->getUsername(), $user->getEmail(), $cle, $emailView); //Ne passer que user pour recup user.name user.token etc...

            $this->emailGenerator->sendEmail($message);
            //$this->mailer->send($message);

            $this->userRepository->save($user);
            $this->imageRepositoryInterface->save($img);

            return true;
        }
        return false;
    }
}