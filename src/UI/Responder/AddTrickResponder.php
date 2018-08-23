<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 11/04/2018
 * Time: 16:25
 */

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\AddTrickResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class AddTrickResponder implements AddTrickResponderInterface
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
     * AddTrickResponder constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param FormInterface $addTrickType
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(bool $redirect = false, FormInterface $addTrickType = null)
    {
        $redirect
            ? $response = new RedirectResponse($this->urlGenerator->generate('home'))
            : $response = new Response(
                $this->twig->render(
                'addTrick.html.twig',
                [
                    'form' => $addTrickType->createView()
                ]
            )
        );

        return $response;
    }
}
