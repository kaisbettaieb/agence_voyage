<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
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
    private $date_reservation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, nullable=true)
     */
    private $nbr_nuits;

    /**
     * @ORM\Column(type="integer",  nullable=true)
     */
    private $nbr_adultes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbr_bebes;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity=LocationChambre::class, mappedBy="reservation")
     */
    private $locationChambres;

    /**
     * @ORM\OneToMany(targetEntity=BilletAvion::class, mappedBy="reservation")
     */
    private $billetAvions;

    /**
     * @ORM\OneToMany(targetEntity=Facture::class, mappedBy="reservation")
     */
    private $factures;

    /**
     * @ORM\OneToMany(targetEntity=Location::class, mappedBy="reservation")
     */
    private $locations;

    public function __construct()
    {
        $this->locationChambres = new ArrayCollection();
        $this->billetAvions = new ArrayCollection();
        $this->factures = new ArrayCollection();
        $this->locations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->date_reservation;
    }

    public function setDateReservation(\DateTimeInterface $date_reservation): self
    {
        $this->date_reservation = $date_reservation;

        return $this;
    }

    public function getNbrNuits(): ?string
    {
        return $this->nbr_nuits;
    }

    public function setNbrNuits(string $nbr_nuits): self
    {
        $this->nbr_nuits = $nbr_nuits;

        return $this;
    }

    public function getNbrAdultes(): ?int
    {
        return $this->nbr_adultes;
    }

    public function setNbrAdultes(int $nbr_adultes): self
    {
        $this->nbr_adultes = $nbr_adultes;

        return $this;
    }

    public function getNbrBebes(): ?int
    {
        return $this->nbr_bebes;
    }

    public function setNbrBebes(int $nbr_bebes): self
    {
        $this->nbr_bebes = $nbr_bebes;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

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
            $locationChambre->setReservation($this);
        }

        return $this;
    }

    public function removeLocationChambre(LocationChambre $locationChambre): self
    {
        if ($this->locationChambres->removeElement($locationChambre)) {
            // set the owning side to null (unless already changed)
            if ($locationChambre->getReservation() === $this) {
                $locationChambre->setReservation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BilletAvion[]
     */
    public function getBilletAvions(): Collection
    {
        return $this->billetAvions;
    }

    public function addBilletAvion(BilletAvion $billet): self
    {
        if (!$this->billetAvions->contains($billet)) {
            $this->billetAvions[] = $billet;
            $billet->setReservation($this);
        }

        return $this;
    }

    public function removeBilletAvion(BilletAvion $billet): self
    {
        if ($this->billetAvions->removeElement($billet)) {
            // set the owning side to null (unless already changed)
            if ($billet->getReservation() === $this) {
                $billet->setReservation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Facture[]
     */
    public function getFactures(): Collection
    {
        return $this->factures;
    }

    public function addFacture(Facture $facture): self
    {
        if (!$this->factures->contains($facture)) {
            $this->factures[] = $facture;
            $facture->setReservation($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): self
    {
        if ($this->factures->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getReservation() === $this) {
                $facture->setReservation(null);
            }
        }

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
            $location->setReservation($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): self
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getReservation() === $this) {
                $location->setReservation(null);
            }
        }

        return $this;
    }
}
