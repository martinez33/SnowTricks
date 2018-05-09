<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/05/2018
 * Time: 14:55
 */

namespace App\UI\Responder\Interfaces;

use Twig\Environment;

interface HomeResponderInterface
{
    public function __construct(Environment $twig);

    public function __invoke(array $tricks);
}