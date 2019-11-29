<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proprietaire
 *
 * @ORM\Table(name="proprietaire", indexes={@ORM\Index(name="fk_proprietaire_typeProprietaire", columns={"codeTypeProprietaire"})})
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
     * @var int
     *
     * @ORM\Column(name="codeTypeProprietaire", type="integer", nullable=false)
     */
    private $codetypeproprietaire;

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

    public function getIdproprietaire(): ?int
    {
        return $this->idproprietaire;
    }

    public function getCodetypeproprietaire(): ?int
    {
        return $this->codetypeproprietaire;
    }

    public function setCodetypeproprietaire(int $codetypeproprietaire): self
    {
        $this->codetypeproprietaire = $codetypeproprietaire;

        return $this;
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
