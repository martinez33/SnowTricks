<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/07/2018
 * Time: 15:43
 */

namespace App\UI\Responder;


use App\UI\Form\Type\RegistrationType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;

class RegistrationResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * RegistrationResponder constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param FormInterface $registrationType
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(FormInterface $registrationType = null, bool $redirect = false)
    {
        $redirect
            ? $response = new RedirectResponse('login')//redirect login
            : $response =  new Response($this->twig->render('registration.html.twig',
                [
                    'form' => $registrationType->createView()
                ]
        ));

        return $response;
    }
}