<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 30/04/2018
 * Time: 09:38
 */

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Responder\Interfaces\RemoveTrickResponderInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

interface RemoveTrickActionInterface
{
    public function __construct(
        Filesystem $fileSystem,
        string $publicDirectory,
        TrickRepositoryInterface $trickRepository,
        SessionInterface $session
    );

    public function __invoke(
        Request $request,
        RemoveTrickResponderInterface $responder
    );
}
