<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 06/08/2018
 * Time: 15:36
 */

namespace App\UI\Responder;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ForgotPasswordResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ForgotPasswordResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param FormInterface $forgotPasswordType
     *
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(FormInterface $forgotPasswordType = null, bool $redirect = false)
    {
        $redirect
            ? $response = new RedirectResponse('login')
            : $response =  new Response($this->twig->render('forgotPassword.html.twig',
            [
                'form' => $forgotPasswordType->createView()
            ]
        ));

        return $response;
    }

}