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
use App\Helper\FileUpLoader;
use App\Helper\Interfaces\FindUrlInterface;
use App\Helper\Interfaces\SlugInterface;
use App\Helper\Interfaces\UniqueTrickNameInterface;
use App\Repository\Interfaces\TrickRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface AddTrickTypeHandlerInterface
{
    public function __construct(
        FileUpLoader $fileUpLoader,
        FindUrlInterface $findUrl,
        ImageBuilderInterface $imageBuilder,
        string $imageUploadFolder,
        SessionInterface $session,
        SlugInterface $slug,
        TrickBuilderInterface $trickBuilder,
        TrickRepositoryInterface $trickRepository,
        UniqueTrickNameInterface $uniqueTrickName,
        VideoBuilderInterface $videoBuilder
    );

    public function handle(FormInterface $form, Request $request): bool;
}
