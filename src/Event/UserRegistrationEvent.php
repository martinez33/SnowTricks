<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/07/2018
 * Time: 23:14
 */

namespace App\Event;


use App\Domain\User;
use Symfony\Component\EventDispatcher\Event;

class UserRegistrationEvent extends Event
{
    const NAME = 'registration.user';
    /**
     * @var User
     */
    private $user;
    /**
     * RegistrationUserEvent constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}