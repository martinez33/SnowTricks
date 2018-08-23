<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 19/07/2018
 * Time: 15:09
 */

namespace App\UI\Responder;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Twig\Environment;

class UserLoginResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * RemoveTrickResponder constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
    }

    /**
     * @param FormInterface $registrationType
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(FormInterface $loginType = null)
    {
            $response = new Response(
            $this->twig->render(
                'Login.html.twig',
                [
                    'form' => $loginType->createView()
                ]
            )
        );

        return $response;
    }



}