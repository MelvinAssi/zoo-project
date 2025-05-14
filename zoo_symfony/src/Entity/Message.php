<?php
namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
#[ORM\Table(name: 'message')]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "NONE")]
    #[ORM\Column(name: 'id_message', type: 'string', length: 50)]
    #[Groups(['message:read'])]
    private ?string $id = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['message:read'])]
    private ?string $name = null;

    #[ORM\Column(type: 'string', length: 100)]
    #[Groups(['message:read'])]
    private ?string $email = null;  

    #[ORM\Column(type: 'string', length: 150)]
    #[Groups(['message:read'])]
    private ?string $subject = null;

    #[ORM\Column(type: 'text')]
    #[Groups(['message:read'])]
    private ?string $content = null;

    #[ORM\Column(type: 'boolean')]
    #[Groups(['message:read'])]
    private bool $is_read;
    
    #[ORM\Column(type: 'boolean')]
    #[Groups(['message:read'])]
    private bool $is_responded;

    #[ORM\Column(type: 'datetime')]
    #[Groups(['message:read'])]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\ManyToOne(targetEntity: Users::class)]
    #[ORM\JoinColumn(name: 'processed_by', referencedColumnName: 'id_users')]    
    #[Groups(['message:read'])]
    private ?Users $processed_by = null;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function isRead(): bool
    {
        return $this->is_read;
    }

    public function setIsRead(bool $is_read): self
    {
        $this->is_read = $is_read;
        return $this;
    }

    public function isResponded(): bool
    {
        return $this->is_responded;
    }

    public function setIsResponded(bool $is_responded): self
    {
        $this->is_responded = $is_responded;
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

    public function getProcessedBy(): ?Users
    {
        return $this->processed_by;
    }

    public function setProcessedBy(?Users $processed_by): self
    {
        $this->processed_by = $processed_by;
        return $this;
    }

}