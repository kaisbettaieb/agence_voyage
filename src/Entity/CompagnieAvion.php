<?php

namespace App\Entity;

use App\Repository\CompagnieAvionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompagnieAvionRepository::class)
 */
class CompagnieAvion
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\Column(type="integer")
     */
    private $code_postal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vile;

       /**
     * @ORM\OneToMany(targetEntity=BilletAvion::class, mappedBy="compagnie_avion")
     */
    private $billetAvions;

    /**
     * @ORM\OneToMany(targetEntity=Offre::class, mappedBy="compagnie_avion")
     */
    private $offres;

    public function __construct()
    {
        $this->billetAvions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodePostal(int $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVile(): ?string
    {
        return $this->vile;
    }

    public function setVile(string $vile): self
    {
        $this->vile = $vile;

        return $this;
    }

    /**
     * @return Collection|BilletAvion[]
     */
    public function getBilletAvions(): Collection
    {
        return $this->billetAvions;
    }

    public function addBilletAvion(BilletAvion $billetAvion): self
    {
        if (!$this->billetAvions->contains($billetAvion)) {
            $this->billetAvions[] = $billetAvion;
            $billetAvion->setCompagnieAvion($this);
        }

        return $this;
    }

    public function removeBilletAvion(BilletAvion $billetAvion): self
    {
        if ($this->billetAvions->removeElement($billetAvion)) {
            // set the owning side to null (unless already changed)
            if ($billetAvion->getCompagnieAvion() === $this) {
                $billetAvion->setCompagnieAvion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Offre[]
     */
    public function getOffres(): Collection
    {
        return $this->offres;
    }

    public function addOffre(Offre $offre): self
    {
        if (!$this->offres->contains($offre)) {
            $this->offres[] = $offre;
            $offre->setCompagnieAvion($this);
        }

        return $this;
    }

    public function removeOffre(Offre $offre): self
    {
        if ($this->offres->removeElement($offre)) {
            // set the owning side to null (unless already changed)
            if ($offre->getCompagnieAvion() === $this) {
                $offre->setCompagnieAvion(null);
            }
        }

        return $this;
    }
}
