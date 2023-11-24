<?php

namespace App\Entity;

use App\Repository\ProgrammeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgrammeRepository::class)]
class Programme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomProgramme = null;

    #[ORM\ManyToOne(inversedBy: 'programmes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Objectif $objectif = null;

    #[ORM\ManyToOne(inversedBy: 'programmes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Niveau $niveau = null;

    #[ORM\ManyToOne(inversedBy: 'programmes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Frequence $frequence = null;

    #[ORM\Column]
    private ?bool $halteres = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProgramme(): ?string
    {
        return $this->nomProgramme;
    }

    public function setNomProgramme(string $nomProgramme): static
    {
        $this->nomProgramme = $nomProgramme;

        return $this;
    }

    public function getObjectif(): ?Objectif
    {
        return $this->objectif;
    }

    public function setObjectif(?Objectif $objectif): static
    {
        $this->objectif = $objectif;

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getFrequence(): ?Frequence
    {
        return $this->frequence;
    }

    public function setFrequence(?Frequence $frequence): static
    {
        $this->frequence = $frequence;

        return $this;
    }

    public function isHalteres(): ?bool
    {
        return $this->halteres;
    }

    public function setHalteres(bool $halteres): static
    {
        $this->halteres = $halteres;

        return $this;
    }
}
