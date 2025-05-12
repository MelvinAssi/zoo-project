<?php

namespace App\Entity;

use App\Repository\EnclosureRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EnclosureRepository::class)]
#[ORM\Table(name: 'enclosure')]
class Enclosure
{
    #[ORM\Id]
    #[Groups(['enclosure:read','animal:read'])]
    #[ORM\Column(name: 'id_enclosure', type: 'string', length: 50)]
    private ?string $id = null;

    #[Groups(['enclosure:read'])]
    #[ORM\Column(type: 'string', length: 50, unique: true)]
    private ?string $name = null;

    #[Groups(['enclosure:read'])]
    #[ORM\Column(name: 'max_capacity', type: 'integer')]
    private ?int $maxCapacity = null;

    #[Groups(['enclosure:read'])]
    #[ORM\Column(name: 'specie_type', type: 'string', length: 50)]
    private ?string $specieType = null;

    #[Groups(['enclosure:read'])]
    #[ORM\Column(type: 'integer')]
    private ?int $localisation = null;

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

    public function getMaxCapacity(): ?int
    {
        return $this->maxCapacity;
    }

    public function setMaxCapacity(int $maxCapacity): self
    {
        $this->maxCapacity = $maxCapacity;
        return $this;
    }

    public function getSpecieType(): ?string
    {
        return $this->specieType;
    }

    public function setSpecieType(string $specieType): self
    {
        $this->specieType = $specieType;
        return $this;
    }

    public function getLocalisation(): ?int
    {
        return $this->localisation;
    }

    public function setLocalisation(int $localisation): self
    {
        $this->localisation = $localisation;
        return $this;
    }
}