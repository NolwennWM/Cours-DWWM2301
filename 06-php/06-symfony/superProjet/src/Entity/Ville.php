<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use App\Traits\TimeStampTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
#[ORM\HasLifecycleCallbacks()]
class Ville
{
    use TimeStampTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message:"Veuillez renseigner ce champ")]
    #[Assert\Length(min:3, max:50)]
    private ?string $nom = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Veuillez renseigner ce champ")]
    #[Assert\Regex("/^\d+$/")]
    private ?int $population = null;

    #[ORM\OneToOne(mappedBy: 'chefLieu', cascade: ['persist', 'remove'])]
    private ?Departement $chefLieu = null;

    #[ORM\ManyToOne(inversedBy: 'Villes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Departement $departement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

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

    public function getPopulation(): ?int
    {
        return $this->population;
    }

    public function setPopulation(int $population): static
    {
        $this->population = $population;

        return $this;
    }

    public function getChefLieu(): ?Departement
    {
        return $this->chefLieu;
    }

    public function setChefLieu(?Departement $chefLieu): static
    {
        // unset the owning side of the relation if necessary
        if ($chefLieu === null && $this->chefLieu !== null) {
            $this->chefLieu->setChefLieu(null);
        }

        // set the owning side of the relation if necessary
        if ($chefLieu !== null && $chefLieu->getChefLieu() !== $this) {
            $chefLieu->setChefLieu($this);
        }

        $this->chefLieu = $chefLieu;

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): static
    {
        $this->departement = $departement;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }
    public function __toString()
    {
        return $this->nom;
    }
}
