<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 31/07/2018
 * Time: 08:43
 */

namespace App\UI\Responder;


use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class InvalidTokenResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * HomeResponder constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @return mixed|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(string $email)
    {
        return new Response($this->twig->render(
            'invalidToken.html.twig',
            array(
                'email' => $email
            )
        ));
    }
}