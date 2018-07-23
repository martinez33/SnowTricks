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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;

class UserRegistrationResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * RemoveTrickResponder constructor.
     *
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
    public function __invoke(FormInterface $registrationType = null, bool $redirect = false)
    {
        dump($registrationType);
        //die;
        $redirect
            ? $response = new Response($this->twig->render('SendEmailMessage.html.twig'))
            : $response =  new Response($this->twig->render('Registration.html.twig',
                ['form' => $registrationType->createView()]));


        return $response;
    }
}