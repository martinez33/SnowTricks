<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 30/04/2018
 * Time: 09:38
 */

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\ImageRepositoryInterface;
use App\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Responder\Interfaces\DelTrickResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

interface DelTrickActionInterface
{
    public function __construct(TrickRepositoryInterface $trickRepository);

    public function __invoke(
        Request $request,
        DelTrickResponderInterface $responder,
        SessionInterface $session
    );
}
