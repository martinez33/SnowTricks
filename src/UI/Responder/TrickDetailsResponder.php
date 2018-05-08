<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/04/2018
 * Time: 18:56
 */

namespace App\UI\Responder;

use App\Domain\Interfaces\TrickInterface;
use App\UI\Responder\Interfaces\TrickDetailsResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class TrickDetailsResponder
 *
 * @package App\UI\Responder
 */
class TrickDetailsResponder implements TrickDetailsResponderInterface
{
    private $twig;

    /**
     * TrickDetailsResponder constructor.
     *
     * @param Environment $twig
     */
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
    public function __invoke(TrickInterface $trick)
    {
        return new Response(
            $this->twig
                ->render(
                'TrickDetails.html.twig',
                    [
                    'trick' => $trick,
                ]
                )
        );
    }
}
