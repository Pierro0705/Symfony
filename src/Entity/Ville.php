<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ville
 *
 * @ORM\Table(name="ville", indexes={@ORM\Index(name="idPays", columns={"idPays"})})
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
     * @var string|null
     *
     * @ORM\Column(name="nomVille", type="string", length=255, nullable=true)
     */
    private $nomville;

    /**
     * @var string|null
     *
     * @ORM\Column(name="codePostal", type="string", length=10, nullable=true)
     */
    private $codepostal;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idPays", type="integer", nullable=true)
     */
    private $idpays;

    public function getIdville(): ?int
    {
        return $this->idville;
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

    public function getIdpays(): ?int
    {
        return $this->idpays;
    }

    public function setIdpays(?int $idpays): self
    {
        $this->idpays = $idpays;

        return $this;
    }


}
