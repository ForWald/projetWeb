<?php

namespace App\Entity;

use App\Repository\OrdreSeanceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: OrdreSeanceRepository::class)]
class OrdreSeance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ordreSeances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Programme $programme = null;

    #[ORM\ManyToOne(inversedBy: 'ordreSeances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Seance $seance = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $ordre = null;

    
    public function __toString(): string
    {
        return $this->seance->getNom();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProgramme(): ?Programme
    {
        return $this->programme;
    }

    public function setProgramme(?Programme $programme): static
    {
        $this->programme = $programme;

        return $this;
    }

    public function getSeance(): ?Seance
    {
        return $this->seance;
    }

    public function setSeance(?Seance $seance): static
    {
        $this->seance = $seance;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): static
    {
        $this->ordre = $ordre;

        return $this;
    }
}
