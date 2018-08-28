<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 27/08/2018
 * Time: 14:47
 */

namespace App\UI\Responder;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RemoveImageResponder
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * RemoveImageResponder constructor.
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }


    public function __invoke(string $slug)
    {

        dump($slug);
        $response = new RedirectResponse($this->urlGenerator->generate(
            'trick_modify',
            [
                'slug' => $slug
            ]
        ));

        return $response;
    }
}