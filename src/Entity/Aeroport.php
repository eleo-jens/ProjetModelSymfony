<?php

namespace App\Entity;

use App\Repository\AeroportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AeroportRepository::class)]
class Aeroport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $code = null;

    #[ORM\OneToMany(mappedBy: 'aeroportDepart', targetEntity: Vol::class)]
    private Collection $volsDepart;

    #[ORM\OneToMany(mappedBy: 'aeroportArrivee', targetEntity: Vol::class)]
    private Collection $volsArrivee;

    public function __construct()
    {
        $this->volsDepart = new ArrayCollection();
        $this->volsArrivee = new ArrayCollection();
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection<int, Vol>
     */
    public function getVolsDepart(): Collection
    {
        return $this->volsDepart;
    }

    public function addVolDepart(Vol $volDepart): self
    {
        if (!$this->volsDepart->contains($volDepart)) {
            $this->volsDepart->add($volDepart);
            $volDepart->setAeroportDepart($this);
        }

        return $this;
    }

    public function removeVolDepart(Vol $volDepart): self
    {
        if ($this->volsDepart->removeElement($volDepart)) {
            // set the owning side to null (unless already changed)
            if ($volDepart->getAeroportDepart() === $this) {
                $volDepart->setAeroportDepart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Vol>
     */
    public function getVolsArrivee(): Collection
    {
        return $this->volsArrivee;
    }

    public function addVolArrivee(Vol $volArrivee): self
    {
        if (!$this->volsArrivee->contains($volArrivee)) {
            $this->volsArrivee->add($volArrivee);
            $volArrivee->setAeroportArrivee($this);
        }

        return $this;
    }

    public function removeVolArrivee(Vol $volArrivee): self
    {
        if ($this->volsArrivee->removeElement($volArrivee)) {
            // set the owning side to null (unless already changed)
            if ($volArrivee->getAeroportArrivee() === $this) {
                $volArrivee->setAeroportArrivee(null);
            }
        }

        return $this;
    }
}
