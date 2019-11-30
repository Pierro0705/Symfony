<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Proprietaire
 *
 * @ORM\Table(name="proprietaire")
 * @ORM\Entity(repositoryClass="App\Repository\ProprietaireRepository")
 */
class Proprietaire
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
     * @ORM\Column(name="nomProprietaire", type="string", length=255, nullable=true)
     */
    private $nomproprietaire;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenomProprietaire", type="string", length=255, nullable=true)
     */
    private $prenomproprietaire;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mailProprietaire", type="string", length=255, nullable=true)
     */
    private $mailproprietaire;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mdpProprietaire", type="string", length=255, nullable=true)
     */
    private $mdpproprietaire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bien", mappedBy="proprietaire")
     */
    private $biens;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Typeproprietaire", inversedBy="proprietaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeproprietaire;

    public function __construct()
    {
        $this->biens = new ArrayCollection();
    }

    /**
     * @return Collection|Bien[]
     */
    public function getBiens(): Collection
    {
        return $this->biens;
    }

    public function addBien(Bien $bien): self
    {
        if (!$this->biens->contains($bien)) {
            $this->biens[] = $bien;
            $bien->setProprietaire($this);
        }

        return $this;
    }

    public function removeBien(Bien $bien): self
    {
        if ($this->biens->contains($bien)) {
            $this->biens->removeElement($bien);
            // set the owning side to null (unless already changed)
            if ($bien->getProprietaire() === $this) {
                $bien->setProprietaire(null);
            }
        }

        return $this;
    }

    public function getTypeproprietaire(): ?Typeproprietaire
    {
        return $this->typeproprietaire;
    }

    public function setTypeproprietaire(?Typeproprietaire $typeproprietaire): self
    {
        $this->typeproprietaire = $typeproprietaire;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomproprietaire(): ?string
    {
        return $this->nomproprietaire;
    }

    public function setNomproprietaire(?string $nomproprietaire): self
    {
        $this->nomproprietaire = $nomproprietaire;

        return $this;
    }

    public function getPrenomproprietaire(): ?string
    {
        return $this->prenomproprietaire;
    }

    public function setPrenomproprietaire(?string $prenomproprietaire): self
    {
        $this->prenomproprietaire = $prenomproprietaire;

        return $this;
    }

    public function getMailproprietaire(): ?string
    {
        return $this->mailproprietaire;
    }

    public function setMailproprietaire(?string $mailproprietaire): self
    {
        $this->mailproprietaire = $mailproprietaire;

        return $this;
    }

    public function getMdpproprietaire(): ?string
    {
        return $this->mdpproprietaire;
    }

    public function setMdpproprietaire(?string $mdpproprietaire): self
    {
        $this->mdpproprietaire = $mdpproprietaire;

        return $this;
    }


}
