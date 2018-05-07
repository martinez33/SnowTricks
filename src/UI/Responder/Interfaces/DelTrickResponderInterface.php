<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 30/04/2018
 * Time: 10:17
 */

namespace App\UI\Responder\Interfaces;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface DelTrickResponderInterface
{
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator);

    public function __invoke();
}
