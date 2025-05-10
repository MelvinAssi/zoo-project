<?php

namespace App\Entity;

use App\Repository\OpeningHoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OpeningHoursRepository::class)]
#[ORM\Table(name: 'opening_hours')]
class OpeningHours
{
    #[ORM\Id]
    #[ORM\Column(type: Types::GUID)]
    #[Groups(['opening_hours:read'])]
    private ?string $id = null;

    #[ORM\Column(name: 'day_', type: Types::STRING, length: 10, unique: true)]
    #[Groups(['opening_hours:read'])]
    private ?string $day = null;

    #[ORM\Column(name: 'opening_time', type: Types::TIME_MUTABLE)]
    #[Groups(['opening_hours:read'])]
    private ?\DateTimeInterface $openingTime = null;

    #[ORM\Column(name: 'closing_time', type: Types::TIME_MUTABLE)]
    #[Groups(['opening_hours:read'])]
    private ?\DateTimeInterface $closingTime = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;
        return $this;
    }

    public function getOpeningTime(): ?\DateTimeInterface
    {
        return $this->openingTime;
    }

    public function setOpeningTime(\DateTimeInterface $openingTime): self
    {
        $this->openingTime = $openingTime;
        return $this;
    }

    public function getClosingTime(): ?\DateTimeInterface
    {
        return $this->closingTime;
    }

    public function setClosingTime(\DateTimeInterface $closingTime): self
    {
        $this->closingTime = $closingTime;
        return $this;
    }
}