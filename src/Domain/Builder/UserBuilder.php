<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 17/07/2018
 * Time: 15:59
 */

namespace App\Domain\Builder;


use App\Domain\Image;
use App\Domain\User;

class UserBuilder
{
    /**
     * @var User
     */
    private $user;

    /**
     * @param Image $picture
     * @param string $username
     * @param string $email
     * @param string $password
     * @param callable $passwordEncoder
     * @return UserBuilder
     * @throws \Exception
     */
    public function createUserRegistration(Image $picture, string $username, string $email, string $password, callable $passwordEncoder): self
    {
        $this->user = new User($picture, $username, $email, $password, $passwordEncoder);

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