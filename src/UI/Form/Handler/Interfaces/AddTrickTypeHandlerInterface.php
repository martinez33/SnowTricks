<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 10/04/2018
 * Time: 02:46
 */

namespace App\UI\Form\Handler\Interfaces;

use App\Domain\Builder\Interfaces\ImageBuilderInterface;
use App\Domain\Builder\Interfaces\TrickBuilderInterface;
use App\Domain\Builder\Interfaces\VideoBuilderInterface;
use App\Domain\Builder\VideoBuilder;
use App\Helper\FileUpLoader;
use App\Helper\FindUrl;
use App\Helper\Interfaces\FindUrlInterface;
use App\Helper\Interfaces\SlugInterface;
use App\Helper\Interfaces\UniqueTrickNameInterface;
use App\Repository\Interfaces\TrickRepositoryInterface;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface AddTrickTypeHandlerInterface
{
    public function __construct(
        SessionInterface $session,
        TrickRepositoryInterface $trickRepository,
        UserRepository $userRepository,
        FileUpLoader $fileUploader,
        string $imageUploadFolder,
        ValidatorInterface $validator,
        TokenStorageInterface $tokenStorage
    );

    public function handle(FormInterface $form, Request $request): bool;
}
