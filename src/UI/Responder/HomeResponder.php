<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 29/03/2018
 * Time: 01:19
 */

namespace App\UI\Responder;

use App\Domain\Image;
use App\Domain\Interfaces\TrickInterface;
use App\Domain\Trick;
use App\Repository\TrickRepository;
use App\UI\Action\HomeAction;
use App\UI\Responder\Interfaces\HomeResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;


class HomeResponder implements HomeResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param array $datas
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(array $datas)
    {
        return new Response($this->twig->render(
            'showTricks.html.twig',
            array('tricks' => $datas)
        ));

    }
}