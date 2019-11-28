<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Louer
 *
 * @ORM\Table(name="louer", indexes={@ORM\Index(name="idBien", columns={"idBien"})})
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
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateArrivee", type="date", nullable=true)
     */
    private $datearrivee;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateDepart", type="date", nullable=true)
     */
    private $datedepart;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdbien(): ?int
    {
        return $this->idbien;
    }

    public function getDatearrivee(): ?\DateTimeInterface
    {
        return $this->datearrivee;
    }

    public function setDatearrivee(?\DateTimeInterface $datearrivee): self
    {
        $this->datearrivee = $datearrivee;

        return $this;
    }

    public function getDatedepart(): ?\DateTimeInterface
    {
        return $this->datedepart;
    }

    public function setDatedepart(?\DateTimeInterface $datedepart): self
    {
        $this->datedepart = $datedepart;

        return $this;
    }


}
