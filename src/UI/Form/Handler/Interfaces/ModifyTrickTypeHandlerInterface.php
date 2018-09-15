<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 30/04/2018
 * Time: 14:30
 */

namespace App\UI\Form\Handler\Interfaces;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

interface ModifyTrickTypeHandlerInterface
{
    public function handle(FormInterface $form, Request $request);
}
