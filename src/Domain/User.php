<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/07/2018
 * Time: 21:06
 */

namespace App\Domain;


use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface//, \Serializable, EquatableInterface
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    private $id;

    /**
     * @var int
     */
    private $created;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var bool
     */
    private $status;

    /**
     * @var string
     */
    private $tokenRegistration;

    /**
     * @var Trick
     */
    private $trick;

    /**
     * @var array
     */
    private $roles = [];

    /**
     * @var string
     */
    private $salt;

    /**
     * User constructor.
     * @param array $role
     */
    public function __construct(
        string $username,
        string $email,
        string $password,
        callable $passwordEncoder
    ) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $passwordEncoder($password, null);
        $this->created = time();
        $this->id = Uuid::uuid4();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        if (empty($this->roles)) {
            return ['ROLE_USER'];
        }
        return $this->roles;
    }

    /**
     * @param array $role
     */
    public function setRoles($roles): void
    {
        $this->roles[] = $roles;
    }

    /**
     * @return string
     */
    public function getTokenRegistration(): string
    {
        return $this->tokenRegistration;
    }

    /**
     * @param string $tokenRegistration
     */
    public function setTokenRegistration(string $tokenRegistration): void
    {
        $this->tokenRegistration = $tokenRegistration;
    }

    /**
     * @return Trick
     */
    public function getTrick(): Trick
    {
        return $this->trick;
    }

    /**
     * @param Trick $trick
     */
    public function setTrick(Trick $trick): void
    {
        $this->trick = $trick;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getSalt(): ?string
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     */
    public function setSalt(string $salt): void
    {
        $this->salt = $salt;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            //$this->id,
            //$this->username,
            //$this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
   /* public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            //$this->salt,
            ) = unserialize($serialized, array('allowed_classes' => false));
    }*/


    public function eraseCredentials()
    {
    }

    /**
     * @param UserInterface $user
     *
     * @return bool
     */
    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof User) {
            return false;
        }

        if ($this->password !== $user->getPassword()) {
            return false;
        }

        if ($this->salt !== $user->getSalt()) {
            return false;
        }

        if ($this->username !== $user->getUsername()) {
            return false;
        }

        return true;
    }
}