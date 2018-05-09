<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/05/2018
 * Time: 14:53
 */

namespace App\UI\Responder\Interfaces;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface AddTrickResponderInterface
{
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator);

    public function __invoke(bool $redirect = false, FormInterface $addTrickType = null);
}