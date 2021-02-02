<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table("users")
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User extends AbstractEntity
{
    public const STATUS_DISABLED = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_PENDING = 2;

    public const DEFAULT_ROLE = 'ROLE_USER';

    /**
     * @ORM\Column(type="smallint", name="status", options={"default": 1})
     */
    protected int $status = self::STATUS_ACTIVE;

    /**
     * @ORM\Column(type="string", name="username", nullable=false, length=120, unique=true)
     */
    protected ?string $username = null;

    /**
     * @ORM\Column(type="string", name="password")
     */
    protected ?string $password = null;

    /**
     * @ORM\Column(type="json")
     */
    protected array $roles = [];

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;

        // guarantee every user at least has ROLE_USER
        $roles[] = self::DEFAULT_ROLE;

        return array_unique($roles);
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
