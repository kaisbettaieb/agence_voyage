<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\This;

/**
 * @ORM\Entity(repositoryClass=OffreRepository::class)
 */
class Offre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $sieges_disponible;

    /**
     * @ORM\Column(type="date")
     */
    private $date_depart;

    /**
     * @ORM\Column(type="float")
     */
    private $heure_depart;

    /**
     * @ORM\Column(type="date")
     */
    private $date_arrivee;

    /**
     * @ORM\Column(type="float")
     */
    private $heure_arrivee;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $depart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $arrivee;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity=CompagnieAvion::class, inversedBy="offres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $compagnie_avion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSiegesDisponible(): ?int
    {
        return $this->sieges_disponible;
    }

    public function setSiegesDisponible(int $sieges_disponible): self
    {
        $this->sieges_disponible = $sieges_disponible;

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

    public function getHeureDepart(): ?float
    {
        return $this->heure_depart;
    }

    public function setHeureDepart(float $heure_depart): self
    {
        $this->heure_depart = $heure_depart;

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

    public function getHeureArrivee(): ?float
    {
        return $this->heure_arrivee;
    }

    public function setHeureArrivee(float $heure_arrivee): self
    {
        $this->heure_arrivee = $heure_arrivee;

        return $this;
    }

    public function getDepart(): ?string
    {
        return $this->depart;
    }

    public function setDepart(string $depart): self
    {
        $this->depart = $depart;

        return $this;
    }

    public function getArrivee(): ?string
    {
        return $this->arrivee;
    }

    public function setArrivee(string $arrivee): self
    {
        $this->arrivee = $arrivee;

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

    public function getCompagnieAvion(): ?CompagnieAvion
    {
        return $this->compagnie_avion;
    }


    public function setCompagnieAvion(CompagnieAvion $compagnie_avion): self
    {
        $this->compagnie_avion = $compagnie_avion;
        return $this;
    }
}
