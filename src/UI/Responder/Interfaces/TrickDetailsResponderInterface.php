<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/05/2018
 * Time: 15:02
 */

namespace App\UI\Responder\Interfaces;

use App\Domain\Interfaces\TrickInterface;
use Twig\Environment;

interface TrickDetailsResponderInterface
{
    public function __construct(Environment $twig);

    public function __invoke(TrickInterface $trick);
}