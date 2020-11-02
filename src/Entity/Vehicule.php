<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass=VehiculeRepository::class)
 */
class Vehicule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero_immatriculation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_vehicule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_hors_taxes_jours;

    /**
     * @ORM\Column(type="float")
     */
    private $km_inclus;

    /**
     * @ORM\OneToMany(targetEntity=Location::class, mappedBy="voiture")
     */
    private $locations;

    /**
     * @ORM\ManyToOne(targetEntity=AgenceLocation::class, inversedBy="voitures")
     */
    private $agence;

    public function __construct()
    {
        $this->locations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroImmatriculation(): ?string
    {
        return $this->numero_immatriculation;
    }

    public function setNumeroImmatriculation(string $numero_immatriculation): self
    {
        $this->numero_immatriculation = $numero_immatriculation;

        return $this;
    }

    public function getTypeVehicule(): ?string
    {
        return $this->type_vehicule;
    }

    public function setTypeVehicule(string $type_vehicule): self
    {
        $this->type_vehicule = $type_vehicule;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getPrixHorsTaxesJours(): ?float
    {
        return $this->prix_hors_taxes_jours;
    }

    public function setPrixHorsTaxesJours(float $prix_hors_taxes_jours): self
    {
        $this->prix_hors_taxes_jours = $prix_hors_taxes_jours;

        return $this;
    }

    public function getKmInclus(): ?float
    {
        return $this->km_inclus;
    }

    public function setKmInclus(float $km_inclus): self
    {
        $this->km_inclus = $km_inclus;

        return $this;
    }

    /**
     * @return Collection|Location[]
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Location $location): self
    {
        if (!$this->locations->contains($location)) {
            $this->locations[] = $location;
            $location->setVoiture($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): self
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getVoiture() === $this) {
                $location->setVoiture(null);
            }
        }

        return $this;
    }

    public function getAgence(): ?AgenceLocation
    {
        return $this->agence;
    }

    public function setAgence(?AgenceLocation $agence): self
    {
        $this->agence = $agence;

        return $this;
    }


    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }
}
