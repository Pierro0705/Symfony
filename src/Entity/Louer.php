<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Louer
 *
 * @ORM\Table(name="louer")
 * @ORM\Entity(repositoryClass="App\Repository\LouerRepository")
 */
class Louer
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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

    /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", length=32, nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="louers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bien", inversedBy="louers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bien;

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getBien(): ?Bien
    {
        return $this->bien;
    }

    public function setBien(?Bien $bien): self
    {
        $this->bien = $bien;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }


}
