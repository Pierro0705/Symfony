<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Typebien
 *
 * @ORM\Table(name="typebien")
 * @ORM\Entity(repositoryClass="App\Repository\TypebienRepository")
 */
class Typebien
{
    /**
     * @var int
     *
     * @ORM\Column(name="codeTypeBien", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codetypebien;

    /**
     * @var string|null
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     */
    private $libelle;

    public function getCodetypebien(): ?int
    {
        return $this->codetypebien;
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
