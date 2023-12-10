<?php

namespace App\Entity;

use App\Repository\OrdreExerciceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: OrdreExerciceRepository::class)]
class OrdreExercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ordreExercices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exercice $exercice = null;

    #[ORM\ManyToOne(inversedBy: 'ordreExercices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Seance $seance = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $ordre = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Expression("not(this.getNbRep()==null)", message: "Si temps n'est pas vide alors nbrep doit l'être")]
    private ?float $temps = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Expression("not(this.getTemps()==null)", message: "Si temps n'est pas vide alors nbrep doit l'être")]
    private ?int $nbRep = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?float $tempsRepos = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $nbSeries = null;

    public function __toString(): string
    {
        return $this->exercice->getNom();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExercice(): ?Exercice
    {
        return $this->exercice;
    }

    public function setExercice(?Exercice $exercice): static
    {
        $this->exercice = $exercice;

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

    public function getTemps(): ?float
    {
        return $this->temps;
    }

    public function setTemps(?float $temps): static
    {
        $this->temps = $temps;

        return $this;
    }

    public function getNbRep(): ?int
    {
        return $this->nbRep;
    }

    public function setNbRep(int $nbRep): static
    {
        $this->nbRep = $nbRep;

        return $this;
    }

    public function getTempsRepos(): ?float
    {
        return $this->tempsRepos;
    }

    public function setTempsRepos(float $tempsRepos): static
    {
        $this->tempsRepos = $tempsRepos;

        return $this;
    }

    public function getNbSeries(): ?int
    {
        return $this->nbSeries;
    }

    public function setNbSeries(int $nbSeries): static
    {
        $this->nbSeries = $nbSeries;

        return $this;
    }


}
