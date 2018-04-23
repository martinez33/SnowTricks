<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/04/2018
 * Time: 18:55
 */

namespace App\UI\Responder\Interfaces;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

interface TrickDetailsResponderInterface
{
    /**
     * TrickDetailsResponderInterface constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig);

    /**
     * @param array $data
     * @return Response
     */
    public function __invoke(array $data, array $img, array $video);
}
