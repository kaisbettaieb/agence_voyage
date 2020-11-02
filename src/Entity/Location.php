<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocationRepository::class)
 */
class Location
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_prise_charge;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_restitution;

    /**
     * @ORM\ManyToOne(targetEntity=Reservation::class, inversedBy="locations")
     */
    private $reservation;

    /**
     * @ORM\ManyToOne(targetEntity=AgenceLocation::class, inversedBy="locations")
     */
    private $agence;

    /**
     * @ORM\ManyToOne(targetEntity=Vehicule::class, inversedBy="locations")
     */
    private $voiture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatePriseCharge(): ?\DateTimeInterface
    {
        return $this->date_prise_charge;
    }

    public function setDatePriseCharge(\DateTimeInterface $date_prise_charge): self
    {
        $this->date_prise_charge = $date_prise_charge;

        return $this;
    }

    public function getDateRestitution(): ?\DateTimeInterface
    {
        return $this->date_restitution;
    }

    public function setDateRestitution(\DateTimeInterface $date_restitution): self
    {
        $this->date_restitution = $date_restitution;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

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

    public function getVoiture(): ?Vehicule
    {
        return $this->voiture;
    }

    public function setVoiture(?Vehicule $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
    }
}
