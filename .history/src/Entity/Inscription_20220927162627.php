<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'id_users')]
    private ?User $User = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'id_examens')]
    private ?Examens $  = null;


    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getExamens(): ?Examens
    {
        return $this->Examens;
    }

    public function setExamens(?Examens $Examens): self
    {
        $this->Examens = $Examens;

        return $this;
    }
}
