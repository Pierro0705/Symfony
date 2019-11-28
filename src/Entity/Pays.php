<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pays
 *
 * @ORM\Table(name="pays")
 * @ORM\Entity(repositoryClass="App\Repository\PaysRepository")
 */
class Pays
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPays", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpays;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nomPays", type="string", length=255, nullable=true)
     */
    private $nompays;

    public function getIdpays(): ?int
    {
        return $this->idpays;
    }

    public function getNompays(): ?string
    {
        return $this->nompays;
    }

    public function setNompays(?string $nompays): self
    {
        $this->nompays = $nompays;

        return $this;
    }


}
