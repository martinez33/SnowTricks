<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 31/07/2018
 * Time: 08:28
 */

namespace App\Security\Guard;


use App\Domain\User;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * LoginFormAuthenticator constructor.
     * @param EventDispatcherInterface $eventDispatcher
     * @param UrlGeneratorInterface $urlGenerator
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     * @param SessionInterface $session
     */
    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        UrlGeneratorInterface $urlGenerator,
        UserPasswordEncoderInterface $userPasswordEncoder,
        SessionInterface $session
    ) {
        $this->eventDispatcher = $eventDispatcher;
        $this->urlGenerator = $urlGenerator;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->session = $session;
    }


    /**
     * @return string
     */
    protected function getLoginUrl()
    {
        return $this->urlGenerator->generate('login');
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function supports(Request $request)
    {
        if ($request->getPathInfo() !== $this->urlGenerator->generate('login') || 'POST' !== $request->getMethod()) {
            return false;
        }

        return true;
    }

    /**
     * @param Request $request
     * @return array|mixed|null
     */
    public function getCredentials(Request $request)
    {
        if (!$request->request->get('login')['username'] || !$request->request->get('login')['password']) {
            return null;
        }

        return [
            'username' => $request->request->get('login')['username'],
            'password' => $request->request->get('login')['password']
        ];
    }

    /**
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     * @return null|\Symfony\Component\Security\Core\User\UserInterface
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $userProvider->loadUserByUsername($credentials['username']);
    }

    /**
     * @param mixed $credentials
     * @param UserInterface $user
     * @return bool|null
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        if ($user->getTokenRegistration() === null && $user->getTokenResetPassword() === null) {

            return $this->userPasswordEncoder->isPasswordValid($user, $credentials['password']);
        }
        return null;
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey
     * @return null|RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return new RedirectResponse($this->urlGenerator->generate('home'));
    }

    /**
     * {@inheritdoc}
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        /*$this->eventDispatcher->dispatch(
            SessionMessageEvent::NAME,
            new SessionMessageEvent('failure', 'security.login_failure')
        );*/
        $this->session->getFlashBag()->add('notice', 'Mot de passe ou idendifiant invalide !');

        return new RedirectResponse($this->urlGenerator->generate('login'));
    }
}