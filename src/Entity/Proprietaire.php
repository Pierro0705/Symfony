<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proprietaire
 *
 * @ORM\Table(name="proprietaire", indexes={@ORM\Index(name="codeT_P", columns={"codeT_P"})})
 * @ORM\Entity(repositoryClass="App\Repository\ProprietaireRepository")
 */
class Proprietaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="idProprietaire", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproprietaire;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nomProprietaire", type="string", length=20, nullable=true)
     */
    private $nomproprietaire;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenomProprietaire", type="string", length=20, nullable=true)
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
     * @ORM\Column(name="telephoneProprietaire", type="string", length=10, nullable=true)
     */
    private $telephoneproprietaire;

    /**
     * @var int|null
     *
     * @ORM\Column(name="codeT_P", type="integer", nullable=true)
     */
    private $codetP;

    public function getIdproprietaire(): ?int
    {
        return $this->idproprietaire;
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

    public function getTelephoneproprietaire(): ?string
    {
        return $this->telephoneproprietaire;
    }

    public function setTelephoneproprietaire(?string $telephoneproprietaire): self
    {
        $this->telephoneproprietaire = $telephoneproprietaire;

        return $this;
    }

    public function getCodetP(): ?int
    {
        return $this->codetP;
    }

    public function setCodetP(?int $codetP): self
    {
        $this->codetP = $codetP;

        return $this;
    }


}
