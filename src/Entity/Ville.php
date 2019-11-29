<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ville
 *
 * @ORM\Table(name="ville", indexes={@ORM\Index(name="fk_ville_pays", columns={"idPays"})})
 * @ORM\Entity(repositoryClass="App\Repository\VilleRepository")
 */
class Ville
{
    /**
     * @var int
     *
     * @ORM\Column(name="idVille", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idville;

    /**
     * @var int
     *
     * @ORM\Column(name="idPays", type="integer", nullable=false)
     */
    private $idpays;

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

    public function getIdville(): ?int
    {
        return $this->idville;
    }

    public function getIdpays(): ?int
    {
        return $this->idpays;
    }

    public function setIdpays(int $idpays): self
    {
        $this->idpays = $idpays;

        return $this;
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
