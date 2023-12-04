<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Seance::class)]
    private Collection $seances;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: CategorieExercice::class)]
    private Collection $categorieExercices;

    public function __construct()
    {
        $this->seances = new ArrayCollection();
        $this->categorieExercices = new ArrayCollection();
    }
    public function __toString(){
        return $this->nom;
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

    /**
     * @return Collection<int, Seance>
     */
    public function getSeances(): Collection
    {
        return $this->seances;
    }

    public function addSeance(Seance $seance): static
    {
        if (!$this->seances->contains($seance)) {
            $this->seances->add($seance);
            $seance->setCategorie($this);
        }

        return $this;
    }

    public function removeSeance(Seance $seance): static
    {
        if ($this->seances->removeElement($seance)) {
            // set the owning side to null (unless already changed)
            if ($seance->getCategorie() === $this) {
                $seance->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CategorieExercice>
     */
    public function getCategorieExercices(): Collection
    {
        return $this->categorieExercices;
    }

    public function addCategorieExercice(CategorieExercice $categorieExercice): static
    {
        if (!$this->categorieExercices->contains($categorieExercice)) {
            $this->categorieExercices->add($categorieExercice);
            $categorieExercice->setCategorie($this);
        }

        return $this;
    }

    public function removeCategorieExercice(CategorieExercice $categorieExercice): static
    {
        if ($this->categorieExercices->removeElement($categorieExercice)) {
            // set the owning side to null (unless already changed)
            if ($categorieExercice->getCategorie() === $this) {
                $categorieExercice->setCategorie(null);
            }
        }

        return $this;
    }
}
