<?php

namespace App\Entity;

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
     * @ORM\Column(name="codeTypeProprietaire", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codetypeproprietaire;

    /**
     * @var string|null
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     */
    private $libelle;

    public function getCodetypeproprietaire(): ?int
    {
        return $this->codetypeproprietaire;
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
