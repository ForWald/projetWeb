<?php

namespace App\Entity;

use App\Repository\SeanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeanceRepository::class)]
class Seance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'seances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'seances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Niveau $niveau = null;

    #[ORM\OneToMany(mappedBy: 'seance', targetEntity: OrdreSeance::class)]
    private Collection $ordreSeances;

    #[ORM\OneToMany(mappedBy: 'seance', targetEntity: OrdreExercice::class)]
    private Collection $ordreExercices;

    public function __construct()
    {
        $this->ordreSeances = new ArrayCollection();
        $this->ordreExercices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

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
            $ordreSeance->setSeance($this);
        }

        return $this;
    }

    public function removeOrdreSeance(OrdreSeance $ordreSeance): static
    {
        if ($this->ordreSeances->removeElement($ordreSeance)) {
            // set the owning side to null (unless already changed)
            if ($ordreSeance->getSeance() === $this) {
                $ordreSeance->setSeance(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OrdreExercice>
     */
    public function getOrdreExercices(): Collection
    {
        return $this->ordreExercices;
    }

    public function addOrdreExercice(OrdreExercice $ordreExercice): static
    {
        if (!$this->ordreExercices->contains($ordreExercice)) {
            $this->ordreExercices->add($ordreExercice);
            $ordreExercice->setSeance($this);
        }

        return $this;
    }

    public function removeOrdreExercice(OrdreExercice $ordreExercice): static
    {
        if ($this->ordreExercices->removeElement($ordreExercice)) {
            // set the owning side to null (unless already changed)
            if ($ordreExercice->getSeance() === $this) {
                $ordreExercice->setSeance(null);
            }
        }

        return $this;
    }
}
