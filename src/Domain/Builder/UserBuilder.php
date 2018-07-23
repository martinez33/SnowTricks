<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 17/07/2018
 * Time: 15:59
 */

namespace App\Domain\Builder;


use App\Domain\User;

class UserBuilder
{
    /**
     * @var User
     */
    private $user;

    public function createUserRegistration(string $username, string $email, string $password, callable $passwordEncoder): self
    {
        $this->user = new User($username, $email, $password, $passwordEncoder);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }
}