<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/04/2018
 * Time: 13:44
 */

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\ListCommentResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ListCommentResponder implements ListCommentResponderInterface
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param array $data
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(array $data)
    {
        return new Response($this->twig->render(
            'showComments.html.twig',
            ['comments' => $data]
        ));
    }
}
