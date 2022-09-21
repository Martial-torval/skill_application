<?php

namespace App\Entity;

use App\Repository\SkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SkillRepository::class)]
class Skill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    private ?string $subtitle = null;

    #[ORM\OneToMany(mappedBy: 'first_name', targetEntity: User::class)]
    private Collection $first_name;

    #[ORM\OneToMany(mappedBy: 'skill', targetEntity: User::class)]
    private Collection $last_name;

    #[ORM\Column]
    private ?int $user_registered = null;

    public function __construct()
    {
        $this->first_name = new ArrayCollection();
        $this->last_name = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getFirstName(): Collection
    {
        return $this->first_name;
    }

    public function addFirstName(User $firstName): self
    {
        if (!$this->first_name->contains($firstName)) {
            $this->first_name->add($firstName);
            $firstName->setFirstName($this);
        }

        return $this;
    }

    public function removeFirstName(User $firstName): self
    {
        if ($this->first_name->removeElement($firstName)) {
            // set the owning side to null (unless already changed)
            if ($firstName->getFirstName() === $this) {
                $firstName->setFirstName(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getLastName(): Collection
    {
        return $this->last_name;
    }

    public function addLastName(User $lastName): self
    {
        if (!$this->last_name->contains($lastName)) {
            $this->last_name->add($lastName);
            $lastName->setSkill($this);
        }

        return $this;
    }

    public function removeLastName(User $lastName): self
    {
        if ($this->last_name->removeElement($lastName)) {
            // set the owning side to null (unless already changed)
            if ($lastName->getSkill() === $this) {
                $lastName->setSkill(null);
            }
        }

        return $this;
    }

    public function getUserRegistered(): ?int
    {
        return $this->user_registered;
    }

    public function setUserRegistered(int $user_registered): self
    {
        $this->user_registered = $user_registered;

        return $this;
    }
}
