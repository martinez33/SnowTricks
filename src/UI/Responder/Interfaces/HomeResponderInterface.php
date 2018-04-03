<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 29/03/2018
 * Time: 01:18
 */

namespace App\UI\Responder\Interfaces;

use Twig\Environment;

interface HomeResponderInterface
{
    public function __construct(Environment $twig);

    public function __invoke(array $datas);
}