<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[ORM\Table(name: 'users')]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "NONE")]
    #[Groups(['user:read'])]
    #[ORM\Column(name: 'id_users', type: 'string', length: 50)]
    private ?string $id = null;

    #[ORM\Column(type: 'string', length: 50, unique: true)]
    #[Groups(['user:read'])]
    private ?string $username;
    
    #[ORM\Column(type: 'string', length: 50, unique: true)]
    #[Groups(['user:read'])]
    private ?string $email;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $password;

    #[ORM\Column(type:"json")]
    #[Groups(['user:read'])]
    private array $roles = [];


    #[ORM\Column(type: 'datetime')]
    #[Groups(['user:read'])]
    private ?\DateTimeInterface $createdAt;

    #[ORM\Column(type: 'boolean')]
    #[Groups(['user:read'])]
    private bool $isActive;

    #[ORM\Column(type: 'boolean')]
    #[Groups(['user:read'])]
    private bool $firstLoginDone;

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    // Getter et Setter pour 'email'
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    // Getter et Setter pour 'password'
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles ?? [];
        if (!in_array('ROLE_USER', $roles, true)) {
            $roles[] = 'ROLE_USER';
        }
         return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    // Getter et Setter pour 'createdAt'
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    // Getter et Setter pour 'isActive'
    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }

    // Getter et Setter pour 'firstLoginDone'
    public function getFirstLoginDone(): bool
    {
        return $this->firstLoginDone;
    }

    public function setFirstLoginDone(bool $firstLoginDone): self
    {
        $this->firstLoginDone = $firstLoginDone;
        return $this;
    }

    // Getter et Setter pour 'id'
    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }





    public function getSalt(): ?string
    {
        return null; // Pas nécessaire avec bcrypt/argon2i
    }

    public function getUserIdentifier(): string
    {
        return $this->email; // ou email si tu préfères
    }

    public function eraseCredentials(): void
    {
        // Efface les infos sensibles (si besoin)
    }

}