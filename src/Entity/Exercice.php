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

    #[ORM\ManyToMany(targetEntity: Niveau::class, inversedBy: 'exercices')]
    private Collection $niveau;

    #[ORM\ManyToMany(targetEntity: Seance::class, inversedBy: 'exercices')]
    private Collection $seances;

    public function __construct()
    {
        $this->niveau = new ArrayCollection();
        $this->seances = new ArrayCollection();
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
     * @return Collection<int, Niveau>
     */
    public function getNiveau(): Collection
    {
        return $this->niveau;
    }

    public function addNiveau(Niveau $niveau): static
    {
        if (!$this->niveau->contains($niveau)) {
            $this->niveau->add($niveau);
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): static
    {
        $this->niveau->removeElement($niveau);

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
        }

        return $this;
    }

    public function removeSeance(Seance $seance): static
    {
        $this->seances->removeElement($seance);

        return $this;
    }
}
