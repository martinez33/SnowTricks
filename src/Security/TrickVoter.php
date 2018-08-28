<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 28/08/2018
 * Time: 00:21
 */

namespace App\Security;


use App\Domain\DTO\TrickDTO;
use App\Domain\Trick;
use App\Domain\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class TrickVoter implements VoterInterface
{
    /**
     * @param TokenInterface $token
     * @param mixed $subject
     * @param array $attributes
     * @return int
     */
    public function vote(TokenInterface $token, $subject, array $attributes)
    {

        dump($subject);
        //die;

        if (!$subject instanceof Trick) {
            return self::ACCESS_ABSTAIN;
        }

        if (!in_array('ROLE_USER', $attributes)) {
            return self::ACCESS_ABSTAIN;
        }

        $user = $token->getUser();
        dump($user);
        //die;

        if (!$user instanceof User) {
            return self::ACCESS_DENIED;
        }

        if($user->getId() !== $subject->getUser()->getId()) {
            return self::ACCESS_DENIED;
        }

        return self::ACCESS_GRANTED;
    }
}