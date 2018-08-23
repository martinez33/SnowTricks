<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/07/2018
 * Time: 15:36
 */

namespace App\UI\Action;

use App\Domain\User;
use App\Helper\TokenValidator;
use App\UI\Form\Handler\RegistrationTypeHandler;
use App\UI\Form\Type\RegistrationType;
use App\UI\Responder\RegistrationResponder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


/**
 * Class UserRegistrationAction
 *
 * @package App\UI\Action
 *
 * @Route(
 *     path="/registration",
 *     name="user_registration"
 * )
 */
class RegistrationAction
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
     * @var TokenValidator
     */
    private $tokenValidator;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * UserRegistrationAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param RegistrationTypeHandler $registrationTypeHandler
     * @param TokenValidator $tokenValidator
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(

        FormFactoryInterface $formFactory,
        RegistrationTypeHandler $registrationTypeHandler,
        TokenValidator $tokenValidator,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->formFactory = $formFactory;
        $this->registrationTypeHandler = $registrationTypeHandler;
        $this->tokenValidator = $tokenValidator;
        $this->urlGenerator = $urlGenerator;
    }


    /**
     * @param RegistrationResponder $responder
     * @param Request $request
     * @param SessionInterface $session
     * @param AuthenticationUtils $authenticationUtils
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        RegistrationResponder $responder,
        Request $request,
        SessionInterface $session,
        AuthenticationUtils $authenticationUtils
    ) {
        $registrationType = $this->formFactory->create(RegistrationType::class)->handleRequest($request);

        if ($this->registrationTypeHandler->handle($registrationType, $request)) {

            $session->getFlashBag()->add('notice', 'Un mail vient de vous être envoyé ! Il se peut qu\' il se soit rangé dans les spams !');

            return $responder($registrationType, true);

        } else {
            return $responder($registrationType, false);
        }
    }

}