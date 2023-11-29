<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $video = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descriptionSiHaltere = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $videoSiHaltere = null;

    #[ORM\OneToMany(mappedBy: 'exercice', targetEntity: OrdreExercice::class)]
    private Collection $ordreExercices;

    #[ORM\OneToMany(mappedBy: 'exercice', targetEntity: CategorieExercice::class)]
    private Collection $categorieExercices;

    #[ORM\ManyToOne(inversedBy: 'exercice')]
    private ?Niveau $niveau = null;

    public function __construct()
    {
        $this->ordreExercices = new ArrayCollection();
        $this->categorieExercices = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(string $video): static
    {
        $this->video = $video;

        return $this;
    }

    public function getDescriptionSiHaltere(): ?string
    {
        return $this->descriptionSiHaltere;
    }

    public function setDescriptionSiHaltere(?string $descriptionSiHaltere): static
    {
        $this->descriptionSiHaltere = $descriptionSiHaltere;

        return $this;
    }

    public function getVideoSiHaltere(): ?string
    {
        return $this->videoSiHaltere;
    }

    public function setVideoSiHaltere(?string $videoSiHaltere): static
    {
        $this->videoSiHaltere = $videoSiHaltere;

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
            $ordreExercice->setExercice($this);
        }

        return $this;
    }

    public function removeOrdreExercice(OrdreExercice $ordreExercice): static
    {
        if ($this->ordreExercices->removeElement($ordreExercice)) {
            // set the owning side to null (unless already changed)
            if ($ordreExercice->getExercice() === $this) {
                $ordreExercice->setExercice(null);
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
            $categorieExercice->setExercice($this);
        }

        return $this;
    }

    public function removeCategorieExercice(CategorieExercice $categorieExercice): static
    {
        if ($this->categorieExercices->removeElement($categorieExercice)) {
            // set the owning side to null (unless already changed)
            if ($categorieExercice->getExercice() === $this) {
                $categorieExercice->setExercice(null);
            }
        }

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
}
