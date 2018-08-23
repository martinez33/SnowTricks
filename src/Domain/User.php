<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/07/2018
 * Time: 21:06
 */

namespace App\Domain;


use Doctrine\Common\Collections\ArrayCollection;
use phpDocumentor\Reflection\Types\Null_;
use phpDocumentor\Reflection\Types\Nullable;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, \Serializable, EquatableInterface
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
     * @var string | null
     */
    private $tokenRegistration;

    /**
     * @var string | null
     */
    private $tokenResetPassword;

    /**
     * @var int
     */
    private $tokenGeneratedTime;

    /**
     * @var ArrayCollection
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
     * @param string $username
     * @param string $email
     * @param string $password
     * @param callable $passwordEncoder
     * @throws \Exception
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
        $this->id = Uuid::uuid4();
        $this->trick = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getCreated(): int
    {
        return $this->created;
    }

    /**
     * @param int $created
     */
    public function setCreated(int $created): void
    {
        $this->created = $created;
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
     * @param callable $passwordEncoder
     * @param string $password
     */
    public function setPassword(callable $passwordEncoder, string $password): void
    {
        $this->password = $passwordEncoder($password, null);
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
     * @return null|string
     */
    public function getTokenRegistration(): ?string
    {
        return $this->tokenRegistration;
    }

    /**
     * @param null|string $tokenRegistration
     */
    public function setTokenRegistration(?string $tokenRegistration): void
    {
        $this->tokenRegistration = $tokenRegistration;
    }

    /**
     * @param null|string $tokenRegistration
     * @param int $tokenGeneratedTime
     * @param int|null $created
     */
    public function setRegistration(?string $tokenRegistration, int $tokenGeneratedTime, ?int $created): void
    {
        $this->tokenRegistration = $tokenRegistration;
        $this->tokenGeneratedTime = $tokenGeneratedTime;
        $this->created = $created;
    }

    /**
     * @param null|string $tokenResetPassword
     * @param int $tokenGeneratedTime
     */
    public function setResetPassword(?string $tokenResetPassword, int $tokenGeneratedTime): void
    {
        $this->tokenResetPassword = $tokenResetPassword;
        $this->tokenGeneratedTime = $tokenGeneratedTime;
    }

    /**
     * @return null|string
     */
    public function getTokenResetPassword(): ?string
    {
        return $this->tokenResetPassword;
    }

    /**
     * @param null|string $tokenResetPassword
     */
    public function setTokenResetPassword(?string $tokenResetPassword): void
    {
        $this->tokenResetPassword = $tokenResetPassword;
    }

    /**
     * @return int
     */
    public function getTokenGeneratedTime(): int
    {
        return $this->tokenGeneratedTime;
    }

    /**
     * @param int $tokenGeneratedTime
     */
    public function setTokenGeneratedTime(int $tokenGeneratedTime): void
    {
        $this->tokenGeneratedTime = $tokenGeneratedTime;
    }

    /**
     * @return ArrayCollection
     */
    public function getTrick(): ArrayCollection
    {
        return $this->trick;
    }

    /**
     * @param ArrayCollection $trick
     */
    public function setTrick(ArrayCollection $collection): void
    {
        $this->trick = $collection;
        foreach ($collection as $trick) {
            $trick->setUser($this);
        }
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
            $this->id,
            $this->username,
            $this->password
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            //$this->salt,
            ) = unserialize($serialized, array('allowed' => false));
    }


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