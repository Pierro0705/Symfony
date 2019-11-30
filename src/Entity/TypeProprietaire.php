<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Typeproprietaire
 *
 * @ORM\Table(name="typeproprietaire")
 * @ORM\Entity(repositoryClass="App\Repository\TypeproprietaireRepository")
 */
class Typeproprietaire
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
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Proprietaire", mappedBy="typeproprietaire")
     */
    private $proprietaires;

    public function __construct()
    {
        $this->proprietaires = new ArrayCollection();
    }

    /**
     * @return Collection|Proprietaire[]
     */
    public function getProprietaires(): Collection
    {
        return $this->proprietaires;
    }

    public function addProprietaire(Proprietaire $proprietaire): self
    {
        if (!$this->proprietaires->contains($proprietaire)) {
            $this->proprietaires[] = $proprietaire;
            $proprietaire->setTypeproprietaire($this);
        }

        return $this;
    }

    public function removeProprietaire(Proprietaire $proprietaire): self
    {
        if ($this->proprietaires->contains($proprietaire)) {
            $this->proprietaires->removeElement($proprietaire);
            // set the owning side to null (unless already changed)
            if ($proprietaire->getTypeproprietaire() === $this) {
                $proprietaire->setTypeproprietaire(null);
            }
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }


}
