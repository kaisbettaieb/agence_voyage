<?php

namespace App\Entity;

use App\Repository\BilletAvionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BilletAvionRepository::class)
 */
class BilletAvion
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
    private $aeroport_depart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $aeroport_arrive;

    /**
     * @ORM\Column(type="float")
     */
    private $heure_depart;

    /**
     * @ORM\Column(type="float")
     */
    private $heure_arrive;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_depart;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_arrivee;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_hors_taxes;

    /**
     * @ORM\Column(type="integer")
     */
    private $num_siege;

    /**
     * @ORM\ManyToOne(targetEntity=CompagnieAvion::class, inversedBy="billetAvions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $compagnie_avion;

    /**
     * @ORM\ManyToOne(targetEntity=Reservation::class, inversedBy="billetAvions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reservation;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAeroportDepart(): ?string
    {
        return $this->aeroport_depart;
    }

    public function setAeroportDepart(string $aeroport_depart): self
    {
        $this->aeroport_depart = $aeroport_depart;

        return $this;
    }

    public function getAeroportArrive(): ?string
    {
        return $this->aeroport_arrive;
    }

    public function setAeroportArrive(string $aeroport_arrive): self
    {
        $this->aeroport_arrive = $aeroport_arrive;

        return $this;
    }

    public function getHeureDepart(): ?float
    {
        return $this->heure_depart;
    }

    public function setHeureDepart(float $heure_depart): self
    {
        $this->heure_depart = $heure_depart;

        return $this;
    }

    public function getHeureArrive(): ?float
    {
        return $this->heure_arrive;
    }

    public function setHeureArrive(float $heure_arrive): self
    {
        $this->heure_arrive = $heure_arrive;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->date_depart;
    }

    public function setDateDepart(\DateTimeInterface $date_depart): self
    {
        $this->date_depart = $date_depart;

        return $this;
    }

    public function getDateArrivee(): ?\DateTimeInterface
    {
        return $this->date_arrivee;
    }

    public function setDateArrivee(\DateTimeInterface $date_arrivee): self
    {
        $this->date_arrivee = $date_arrivee;

        return $this;
    }

    public function getPrixHorsTaxes(): ?float
    {
        return $this->prix_hors_taxes;
    }

    public function setPrixHorsTaxes(float $prix_hors_taxes): self
    {
        $this->prix_hors_taxes = $prix_hors_taxes;

        return $this;
    }

    public function getNumSiege(): ?int
    {
        return $this->num_siege;
    }

    public function setNumSiege(int $num_siege): self
    {
        $this->num_siege = $num_siege;

        return $this;
    }

    public function getCompagnieAvion(): ?CompagnieAvion
    {
        return $this->compagnie_avion;
    }

    public function setCompagnieAvion(?CompagnieAvion $compagnie_avion): self
    {
        $this->compagnie_avion = $compagnie_avion;

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
}
