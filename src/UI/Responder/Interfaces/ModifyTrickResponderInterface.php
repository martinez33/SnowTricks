<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/05/2018
 * Time: 14:59
 */

namespace App\UI\Responder\Interfaces;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface ModifyTrickResponderInterface
{
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator);

    public function __invoke(bool $redirect = false, FormInterface $modifyTrickType = null);
}