<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 13/09/2018
 * Time: 14:44
 */

namespace App\UI\Form\Handler;

use App\Domain\Image;
use App\Domain\Trick;
use App\Helper\FileUpLoader;
use App\Repository\Interfaces\TrickRepositoryInterface;
use App\Repository\UserRepository;
use App\UI\Form\Handler\Interfaces\AddTrickTypeHandlerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
/**
 * Class AddTrickTypeHandler
 *
 * @package App\Form\Handler
 */
class AddTrickTypeHandler implements AddTrickTypeHandlerInterface
{
    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var TrickRepositoryInterface
     */
    private $trickRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var FileUpLoader
     */
    private $fileUploader;

    /**
     * @var string
     */
    private $imageUploadFolder;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * AddTrickTypeHandler constructor.
     * @param SessionInterface $session
     * @param TrickRepositoryInterface $trickRepository
     * @param UserRepository $userRepository
     * @param FileUpLoader $fileUploader
     * @param string $imageUploadFolder
     * @param ValidatorInterface $validator
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        SessionInterface $session,
        TrickRepositoryInterface $trickRepository,
        UserRepository $userRepository,
        FileUpLoader $fileUploader,
        string $imageUploadFolder,
        ValidatorInterface $validator,
        TokenStorageInterface $tokenStorage
    ) {
        $this->session = $session;
        $this->trickRepository = $trickRepository;
        $this->userRepository = $userRepository;
        $this->fileUploader = $fileUploader;
        $this->imageUploadFolder = $imageUploadFolder;
        $this->validator = $validator;
        $this->tokenStorage = $tokenStorage;
    }
    /**
     * @param FormInterface $form
     * @param Request $request
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     */
    public function handle(FormInterface $form, Request $request): bool
    {

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($form['image']->getData() as $key => $img) {
                $file = $img->getFile();
                $filename = $this->fileUploader->upLoadImg($file);
                $img->setExt($file->getClientOriginalExtension());
                $img->setFileName($this->imageUploadFolder.$filename);
                $img->setStorageId($filename);
                $key === 0 ? $img->setFirst(true) : $img->setFirst(false);
            }
            $errors = $this->validator->validate($form->getData(), null, array('creation'));
            if(count($errors) > 0) {
                $max = count($errors);
                for ($i=0; $i<$max; $i++) {
                    $this->session->getFlashBag()->add('form_notice', $errors[$i]->getMessage());
                }
                return false;
            }

            $user = $this->tokenStorage->getToken()->getUser();

            $trick =  new Trick($form->getData());

            $tab = new ArrayCollection();
            $tab->add($trick);

            $user->setTrick($tab);

            $this->trickRepository->save($trick);

            return true;
        }
        return false;
    }
}