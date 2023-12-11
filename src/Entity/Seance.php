<?php

namespace App\Entity;

use App\Repository\SeanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: SeanceRepository::class)]
#[Vich\Uploadable]
class Seance implements Serializable
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

    #[ORM\OneToMany(mappedBy: 'seance', targetEntity: OrdreExercice::class, cascade: ["persist"])]
    #[Assert\Valid]
    private Collection $ordreExercices;
    private $exercice;

    #[Vich\UploadableField(mapping: 'seance_images', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Assert\NotNull()]
    private \DateTimeImmutable $updatedAt;

    public function __construct()
    {
        $this->ordreSeances = new ArrayCollection();
        $this->ordreExercices = new ArrayCollection();
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
        ));
        
        }
        
    public function unserialize($serialized) {
        
        list (
        $this->id,
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
    public function getExercice(): ?Exercice
    {
        return $this->exercice;
    }
    public function getImagePath(): ?string
    {
        return 'images/seance/' . $this->imageName;
    }
    public function getExercices(): Collection
    {
        $exercices = new ArrayCollection();

        foreach ($this->ordreExercices as $ordreExercice) {
            $exercices[] = $ordreExercice->getExercice();
        }

        return $exercices;
    }
}
