<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 30/04/2018
 * Time: 14:49
 */

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\ModifyTrickResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class ModifyTrickResponder implements ModifyTrickResponderInterface
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
     * ModifyTrickResponder constructor.
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
     * @param bool $redirect
     * @param null $modifyTrickType
     * @return RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(bool $redirect = false, FormInterface $modifyTrickType = null)
    {
        $redirect
            ? $response = new RedirectResponse($this->urlGenerator->generate('home'))
            : $response = new Response(
            $this->twig->render(
                'ModifyTrick.html.twig',
                [
                    'form' => $modifyTrickType->createView()
                ]
            )
        );

        return $response;
    }
}
