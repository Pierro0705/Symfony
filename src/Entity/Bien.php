<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Bien
 *
 * @ORM\Table(name="bien")
 * @ORM\Entity(repositoryClass="App\Repository\BienRepository")
 */
class Bien
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresseBien", type="string", length=255, nullable=true)
     */
    private $adressebien;

    /**
     * @var int|null
     *
     * @ORM\Column(name="superficieBien", type="integer", nullable=true)
     */
    private $superficiebien;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nbPlaces", type="integer", nullable=true)
     */
    private $nbplaces;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ville", inversedBy="biens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Proprietaire", inversedBy="biens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $proprietaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Typebien", inversedBy="biens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typebien;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Louer", mappedBy="bien")
     */
    private $louers;

    public function __construct()
    {
        $this->louers = new ArrayCollection();
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getProprietaire(): ?Proprietaire
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?Proprietaire $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    public function getTypebien(): ?Typebien
    {
        return $this->typebien;
    }

    public function setTypebien(?Typebien $typebien): self
    {
        $this->typebien = $typebien;

        return $this;
    }

    /**
     * @return Collection|Louer[]
     */
    public function getLouers(): Collection
    {
        return $this->louers;
    }

    public function addLouer(Louer $louer): self
    {
        if (!$this->louers->contains($louer)) {
            $this->louers[] = $louer;
            $louer->setBien($this);
        }

        return $this;
    }

    public function removeLouer(Louer $louer): self
    {
        if ($this->louers->contains($louer)) {
            $this->louers->removeElement($louer);
            // set the owning side to null (unless already changed)
            if ($louer->getBien() === $this) {
                $louer->setBien(null);
            }
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdressebien(): ?string
    {
        return $this->adressebien;
    }

    public function setAdressebien(?string $adressebien): self
    {
        $this->adressebien = $adressebien;

        return $this;
    }

    public function getSuperficiebien(): ?int
    {
        return $this->superficiebien;
    }

    public function setSuperficiebien(?int $superficiebien): self
    {
        $this->superficiebien = $superficiebien;

        return $this;
    }

    public function getNbplaces(): ?int
    {
        return $this->nbplaces;
    }

    public function setNbplaces(?int $nbplaces): self
    {
        $this->nbplaces = $nbplaces;

        return $this;
    }


}
