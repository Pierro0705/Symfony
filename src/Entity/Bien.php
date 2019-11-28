<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bien
 *
 * @ORM\Table(name="bien", indexes={@ORM\Index(name="idVille", columns={"idVille"}), @ORM\Index(name="codeT_B", columns={"codeT_B"})})
 * @ORM\Entity(repositoryClass="App\Repository\BienRepository")
 */
class Bien
{
    /**
     * @var int
     *
     * @ORM\Column(name="idBien", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idbien;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresseBien", type="string", length=255, nullable=true)
     */
    private $adressebien;

    /**
     * @var string|null
     *
     * @ORM\Column(name="superficeBien", type="string", length=255, nullable=true)
     */
    private $superficebien;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nbPlace", type="string", length=5, nullable=true)
     */
    private $nbplace;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prix", type="string", length=5, nullable=true)
     */
    private $prix;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idVille", type="integer", nullable=true)
     */
    private $idville;

    /**
     * @var int|null
     *
     * @ORM\Column(name="codeT_B", type="integer", nullable=true)
     */
    private $codetB;

    public function getIdbien(): ?int
    {
        return $this->idbien;
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

    public function getSuperficebien(): ?string
    {
        return $this->superficebien;
    }

    public function setSuperficebien(?string $superficebien): self
    {
        $this->superficebien = $superficebien;

        return $this;
    }

    public function getNbplace(): ?string
    {
        return $this->nbplace;
    }

    public function setNbplace(?string $nbplace): self
    {
        $this->nbplace = $nbplace;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(?string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getIdville(): ?int
    {
        return $this->idville;
    }

    public function setIdville(?int $idville): self
    {
        $this->idville = $idville;

        return $this;
    }

    public function getCodetB(): ?int
    {
        return $this->codetB;
    }

    public function setCodetB(?int $codetB): self
    {
        $this->codetB = $codetB;

        return $this;
    }


}
