<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeProprietaire
 *
 * @ORM\Table(name="type_proprietaire")
 * @ORM\Entity(repositoryClass="App\Repository\TypeProprietaireRepository")
 */
class TypeProprietaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="codeT_P", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codetP;

    /**
     * @var string|null
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     */
    private $libelle;

    public function getCodetP(): ?int
    {
        return $this->codetP;
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
