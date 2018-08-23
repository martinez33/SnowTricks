<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 19/07/2018
 * Time: 15:01
 */

namespace App\UI\Action;


use App\UI\Form\Handler\LoginTypeHandler;
use App\UI\Form\Type\LoginType;
use App\UI\Responder\UserLoginResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class UserLoginAction
 *
 * @package App\UI\Action
 *
 * @Route(
 *     path="/login/",
 *     name="login",
 *     methods={"POST", "GET"},
 *     defaults={
 *         "_locale": "%locale%"
 *     }
 * )
 */
class UserLoginAction
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * UserLoginAction constructor.
     *
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    /**
     * @param UserLoginResponder $responder
     *
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        UserLoginResponder $responder
    ) {
       $loginType = $this->formFactory->create(LoginType::class);

           return $responder($loginType);
    }
}