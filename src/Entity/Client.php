<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
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
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mdp", type="string", length=255, nullable=true)
     */
    private $mdp;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Louer", mappedBy="client")
     */
    private $louers;

    public function __construct()
    {
        $this->louers = new ArrayCollection();
    }

    /**
     * @return Collection|Louer[]
     */
    public function getLouers(): Collection
    {
        return $this->louers;
    }

    public function addLouer(Louer $louer): self
    {
        if (!$this->louers->contains($louer)) {
            $this->louers[] = $louer;
            $louer->setClient($this);
        }

        return $this;
    }

    public function removeLouer(Louer $louer): self
    {
        if ($this->louers->contains($louer)) {
            $this->louers->removeElement($louer);
            // set the owning side to null (unless already changed)
            if ($louer->getClient() === $this) {
                $louer->setClient(null);
            }
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(?string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }


}
