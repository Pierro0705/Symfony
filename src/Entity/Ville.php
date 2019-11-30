<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ville
 *
 * @ORM\Table(name="ville")
 * @ORM\Entity(repositoryClass="App\Repository\VilleRepository")
 */
class Ville
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
     * @ORM\Column(name="nomVille", type="string", length=255, nullable=true)
     */
    private $nomville;

    /**
     * @var string|null
     *
     * @ORM\Column(name="codePostal", type="string", length=32, nullable=true)
     */
    private $codepostal;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bien", mappedBy="ville")
     */
    private $biens;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pays", inversedBy="villes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pays;

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
            $bien->setVille($this);
        }

        return $this;
    }

    public function removeBien(Bien $bien): self
    {
        if ($this->biens->contains($bien)) {
            $this->biens->removeElement($bien);
            // set the owning side to null (unless already changed)
            if ($bien->getVille() === $this) {
                $bien->setVille(null);
            }
        }

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomville(): ?string
    {
        return $this->nomville;
    }

    public function setNomville(?string $nomville): self
    {
        $this->nomville = $nomville;

        return $this;
    }

    public function getCodepostal(): ?string
    {
        return $this->codepostal;
    }

    public function setCodepostal(?string $codepostal): self
    {
        $this->codepostal = $codepostal;

        return $this;
    }


}
