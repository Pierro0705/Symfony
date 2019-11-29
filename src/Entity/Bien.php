<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bien
 *
 * @ORM\Table(name="bien", indexes={@ORM\Index(name="fk_bien_typeBien", columns={"codeTypeBien"}), @ORM\Index(name="fk_bien_ville", columns={"idVille"}), @ORM\Index(name="fk_bien_proprietaire", columns={"idProprietaire"})})
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
     * @var int
     *
     * @ORM\Column(name="idVille", type="integer", nullable=false)
     */
    private $idville;

    /**
     * @var int
     *
     * @ORM\Column(name="codeTypeBien", type="integer", nullable=false)
     */
    private $codetypebien;

    /**
     * @var int
     *
     * @ORM\Column(name="idProprietaire", type="integer", nullable=false)
     */
    private $idproprietaire;

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

    public function getIdbien(): ?int
    {
        return $this->idbien;
    }

    public function getIdville(): ?int
    {
        return $this->idville;
    }

    public function setIdville(int $idville): self
    {
        $this->idville = $idville;

        return $this;
    }

    public function getCodetypebien(): ?int
    {
        return $this->codetypebien;
    }

    public function setCodetypebien(int $codetypebien): self
    {
        $this->codetypebien = $codetypebien;

        return $this;
    }

    public function getIdproprietaire(): ?int
    {
        return $this->idproprietaire;
    }

    public function setIdproprietaire(int $idproprietaire): self
    {
        $this->idproprietaire = $idproprietaire;

        return $this;
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
