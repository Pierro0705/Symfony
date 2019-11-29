<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Louer
 *
 * @ORM\Table(name="louer", indexes={@ORM\Index(name="fk_louer_client", columns={"id"})})
 * @ORM\Entity(repositoryClass="App\Repository\LouerRepository")
 */
class Louer
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="idBien", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idbien;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dateArrivee", type="string", length=32, nullable=true)
     */
    private $datearrivee;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dateDepart", type="string", length=32, nullable=true)
     */
    private $datedepart;

    /**
     * @var int|null
     *
     * @ORM\Column(name="PRIX", type="integer", nullable=true)
     */
    private $prix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdbien(): ?int
    {
        return $this->idbien;
    }

    public function getDatearrivee(): ?string
    {
        return $this->datearrivee;
    }

    public function setDatearrivee(?string $datearrivee): self
    {
        $this->datearrivee = $datearrivee;

        return $this;
    }

    public function getDatedepart(): ?string
    {
        return $this->datedepart;
    }

    public function setDatedepart(?string $datedepart): self
    {
        $this->datedepart = $datedepart;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(?int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }


}
