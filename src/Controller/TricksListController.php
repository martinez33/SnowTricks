<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 20/03/2018
 * Time: 01:15
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Trick;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TricksListController extends Controller
{
    /**
     * @Route(
     *     path="/tricks",
     *     methods="GET",
     *     name="tricks"
     * )
     * @return Response
     */
    public function showTricks()
    {
        $tricks = $this->getDoctrine()
            ->getRepository(Trick::class)
            ->findAll();

        if(!$tricks) {
            throw $this->createNotFoundException(
                'Le trick n\'existe pas !'
            );
        }

        return $this->render(
            'showTricks.html.twig',
            array(
                'tricks' => $tricks
            )
        );
    }
}