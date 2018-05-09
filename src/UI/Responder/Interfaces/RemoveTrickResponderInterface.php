<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/05/2018
 * Time: 15:01
 */

namespace App\UI\Responder\Interfaces;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface RemoveTrickResponderInterface
{
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator);

    public function __invoke();
}