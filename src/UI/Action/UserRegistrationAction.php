<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/07/2018
 * Time: 15:36
 */

namespace App\UI\Action;

use App\Domain\User;
use App\UI\Form\Handler\RegistrationTypeHandler;
use App\UI\Form\Type\RegistrationType;
use App\UI\Responder\UserRegistrationResponder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


/**
 * Class UserRegistrationAction
 *
 * @package App\UI\Action
 * @Route( path="/en/registration",
 *     name="user_registration")
 */
class UserRegistrationAction
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var RegistrationTypeHandler
     */
    private $registrationTypeHandler;

    /**
     * UserRegistrationAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param RegistrationTypeHandler $registrationTypeHandler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        RegistrationTypeHandler $registrationTypeHandler
    ) {
        $this->formFactory = $formFactory;
        $this->registrationTypeHandler = $registrationTypeHandler;
    }

    /**
     * @param UserRegistrationResponder $responder
     * @param Request $request
     * @param SessionInterface $session
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        UserRegistrationResponder $responder,
        Request $request,
        SessionInterface $session,
        AuthenticationUtils $authenticationUtils
    ) {
        //$user = new User();
        $registrationType = $this->formFactory->create(RegistrationType::class)->handleRequest($request);


        if ($this->registrationTypeHandler->handle($registrationType, $request)) {

            return $responder($registrationType, true);
        } else {
            return $responder($registrationType, false);
        }

    }

}