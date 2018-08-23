<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 30/07/2018
 * Time: 02:27
 */

namespace App\UI\Action;

use App\Helper\EmailGenerator;
use App\Helper\TokenGenerator;
use App\Helper\TokenValidator;
use App\Repository\UserRepository;
use App\UI\Responder\InvalidTokenResponder;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class TokenValidationRegister
 * @package App\UI\Action
 *
 * @Route(
 *     path="/validation/{token}",
 *     name="validation_register"
 *     )
 */
class ValidationRegisterAction
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var TokenValidator
     */
    private $tokenValidator;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var EmailGenerator
     */
    private $emailGenerator;

    /**
     * ValidationRegisterAction constructor.
     * @param UrlGeneratorInterface $urlGenerator
     * @param TokenValidator $tokenValidator
     * @param SessionInterface $session
     * @param EmailGenerator $emailGenerator
     */
    public function __construct(
        UrlGeneratorInterface $urlGenerator,
        TokenValidator $tokenValidator,
        SessionInterface $session,
        EmailGenerator $emailGenerator
    ) {
        $this->urlGenerator = $urlGenerator;
        $this->tokenValidator = $tokenValidator;
        $this->session = $session;
        $this->emailGenerator = $emailGenerator;
    }

    /**
     * @param Request $request
     * @param InvalidTokenResponder $responder
     * @return RedirectResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, InvalidTokenResponder $responder)
    {
        $token = $request->attributes->get('token');

        $email = 'emails/emailRegistration.html.twig';

        $valid = $this->tokenValidator->validationToken($token, true, $email);

        if ($valid === true ) {

            return new RedirectResponse($this->urlGenerator->generate('login'));

        } else {

            $this->session->getFlashBag()->add('notice', 'Le mail de confirmation est expiré ! Un nouveau mail de confirmation vient de vous être envoyé !');

            return new RedirectResponse($this->urlGenerator->generate('login'));
        }
    }
}