<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Users;
use App\Entity\Enclosure;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
#[ORM\Table(name: 'animal')]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "NONE")]
    #[ORM\Column(name: 'id_animal', type: 'string', length: 50)]
    #[Groups(['animal:read'])]
    private ?string $id = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['animal:read'])]
    private ?string $name = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['animal:read'])]
    private ?string $specie = null;

    #[ORM\Column(type: 'integer')]
    #[Groups(['animal:read'])]
    private ?int $age = null;

    #[ORM\Column(type: 'text')]
    #[Groups(['animal:read'])]
    private ?string $description = null;

    #[ORM\Column(type: 'text')]
    #[Groups(['animal:read'])]
    private ?string $photo = null;

    #[ORM\Column(type: 'datetime')]
    #[Groups(['animal:read'])]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: 'datetime')]
    #[Groups(['animal:read'])]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\ManyToOne(targetEntity: Users::class)]
    #[ORM\JoinColumn(name: 'created_by', referencedColumnName: 'id_users')]    
    #[Groups(['animal:read'])]
    private ?Users $createdBy = null;

    #[ORM\ManyToOne(targetEntity: Users::class)]    
    #[ORM\JoinColumn(name: 'updated_by', referencedColumnName: 'id_users')]
    #[Groups(['animal:read'])]
    private ?Users $updatedBy = null;

    #[ORM\ManyToOne(targetEntity: Enclosure::class)]
    #[ORM\JoinColumn(name: 'id_enclosure', referencedColumnName: 'id_enclosure')]
    #[Groups(['animal:read'])]
    private ?Enclosure $enclosure = null;

    // --- Getters & Setters ---

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getSpecie(): ?string
    {
        return $this->specie;
    }

    public function setSpecie(string $specie): self
    {
        $this->specie = $specie;
        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    public function getCreatedBy(): ?Users
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?Users $createdBy): self
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function getUpdatedBy(): ?Users
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?Users $updatedBy): self
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    public function getEnclosure(): ?Enclosure
    {
        return $this->enclosure;
    }

    public function setEnclosure(?Enclosure $enclosure): self
    {
        $this->enclosure = $enclosure;
        return $this;
    }
}
