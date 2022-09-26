<?php

namespace App\Entity;

use App\Repository\ExamensRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExamensRepository::class)]
class Examens
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'competences', targetEntity: Competences::class)]
    private Competences $competences;

    #[ORM\OneToMany(mappedBy: 'Examens', targetEntity: Inscription::class)]
    private Collection $id_examens;

    public function __construct()
    {
        $this->id_examens = new ArrayCollection();
    }

    public function getCompetences() {
        return $this->competences;
    } 

    public function setCompetences($competences) {
        $this->competences = $competences;
    } 


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

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

    /**
     * @return Collection<int, Inscription>
     */
    public function getIdExamens(): Collection
    {
        return $this->id_examens;
    }

    public function addIdExamen(Inscription $idExamen): self
    {
        if (!$this->id_examens->contains($idExamen)) {
            $this->id_examens->add($idExamen);
            $idExamen->setExamens($this);
        }

        return $this;
    }

    public function removeIdExamen(Inscription $idExamen): self
    {
        if ($this->id_examens->removeElement($idExamen)) {
            // set the owning side to null (unless already changed)
            if ($idExamen->getExamens() === $this) {
                $idExamen->setExamens(null);
            }
        }

        return $this;
    }
}
