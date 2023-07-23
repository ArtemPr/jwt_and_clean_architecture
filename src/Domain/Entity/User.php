<?php

namespace App\Domain\Entity;

use App\Domain\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $success_url = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fail_url = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bankLogin = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bankPassword = null;

    #[ORM\Column(nullable: true)]
    private ?int $driver = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getSuccessUrl(): ?string
    {
        return $this->success_url;
    }

    public function setSuccessUrl(?string $success_url): void
    {
        $this->success_url = $success_url;
    }

    public function getFailUrl(): ?string
    {
        return $this->fail_url;
    }

    public function setFailUrl(?string $fail_url): void
    {
        $this->fail_url = $fail_url;
    }

    public function getBankLogin(): ?string
    {
        return $this->bankLogin;
    }

    public function setBankLogin(?string $bankLogin): void
    {
        $this->bankLogin = $bankLogin;
    }

    public function getBankPassword(): ?string
    {
        return $this->bankPassword;
    }

    public function setBankPassword(?string $bankPassword): void
    {
        $this->bankPassword = $bankPassword;
    }

    public function getDriver(): ?int
    {
        return $this->driver;
    }

    public function setDriver(?int $driver): void
    {
        $this->driver = $driver;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
