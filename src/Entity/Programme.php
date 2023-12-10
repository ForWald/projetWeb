<?php

namespace App\Entity;

use Serializable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProgrammeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;



#[ORM\Entity(repositoryClass: ProgrammeRepository::class)]
#[Vich\Uploadable]
class Programme implements Serializable
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

    #[Vich\UploadableField(mapping: 'programme_images', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName = null;

    #[ORM\OneToMany(mappedBy: 'programme', targetEntity: OrdreSeance::class,cascade: ["persist"])]
    private Collection $ordreSeances;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Assert\NotNull()]
    private \DateTimeImmutable $updatedAt;

    public function __construct()
    {
        $this->ordreSeances = new ArrayCollection();
        $this->updatedAt = new \DateTimeImmutable();
    }
    #[ORM\PrePersist()]
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function serialize() {

        return serialize(array(
        $this->id,
        $this->nomProgramme,
        ));
        
        }
        
    public function unserialize($serialized) {
        
        list (
        $this->id,
        $this->nomProgramme,
        ) = unserialize($serialized);
    }
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }
    public function getImageName(): ?string
    {
        return $this->imageName;
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

    public function getImagePath(): ?string
    {
        return 'images/programme/' . $this->imageName;
    }
}
