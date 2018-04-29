<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/04/2018
 * Time: 13:42
 */

namespace App\UI\Responder\Interfaces;

use Twig\Environment;

interface ListCommentResponderInterface
{
    public function __construct(Environment $twig);

    public function __invoke(array $data);
}
