<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 07/08/2018
 * Time: 02:17
 */

namespace App\UI\Responder;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class ResetPasswordResponder
{
    /**
     * @var Environment
     */
    private  $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * ResetPasswordResponder constructor.
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }


    /**
     * @param FormInterface $registrationType
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(FormInterface $resetPasswordType = null, bool $redirect = false)
    {
        $redirect
            ? $response = new RedirectResponse($this->urlGenerator->generate('login'))
            : $response =  new Response($this->twig->render('resetPassword.html.twig',
            [
                'form' => $resetPasswordType->createView()
            ]
        ));

        return $response;
    }
}