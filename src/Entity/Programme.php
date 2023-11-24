<?php

namespace App\Entity;

use App\Repository\ProgrammeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'programme', targetEntity: OrdreSeance::class)]
    private Collection $ordreSeances;

    public function __construct()
    {
        $this->ordreSeances = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, OrdreSeance>
     */
    public function getOrdreSeances(): Collection
    {
        return $this->ordreSeances;
    }

    public function addOrdreSeance(OrdreSeance $ordreSeance): static
    {
        if (!$this->ordreSeances->contains($ordreSeance)) {
            $this->ordreSeances->add($ordreSeance);
            $ordreSeance->setProgramme($this);
        }

        return $this;
    }

    public function removeOrdreSeance(OrdreSeance $ordreSeance): static
    {
        if ($this->ordreSeances->removeElement($ordreSeance)) {
            // set the owning side to null (unless already changed)
            if ($ordreSeance->getProgramme() === $this) {
                $ordreSeance->setProgramme(null);
            }
        }

        return $this;
    }
}
