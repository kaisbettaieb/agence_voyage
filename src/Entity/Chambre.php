<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChambreRepository::class)
 */
class Chambre
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
    private $type;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity=Hotel::class, inversedBy="chambres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hotel;

    /**
     * @ORM\OneToMany(targetEntity=LocationChambre::class, mappedBy="chambre")
     */
    private $locationChambres;

    public function __construct()
    {
        $this->locationChambres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * @return Collection|LocationChambre[]
     */
    public function getLocationChambres(): Collection
    {
        return $this->locationChambres;
    }

    public function addLocationChambre(LocationChambre $locationChambre): self
    {
        if (!$this->locationChambres->contains($locationChambre)) {
            $this->locationChambres[] = $locationChambre;
            $locationChambre->setChambre($this);
        }

        return $this;
    }

    public function removeLocationChambre(LocationChambre $locationChambre): self
    {
        if ($this->locationChambres->removeElement($locationChambre)) {
            // set the owning side to null (unless already changed)
            if ($locationChambre->getChambre() === $this) {
                $locationChambre->setChambre(null);
            }
        }

        return $this;
    }
}
