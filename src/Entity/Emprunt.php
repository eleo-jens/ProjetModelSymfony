<?php

namespace App\Entity;

use App\Repository\EmpruntRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmpruntRepository::class)]
class Emprunt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateEmprunt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateRetour = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaires = null;

    #[ORM\ManyToOne(inversedBy: 'emprunts')]
    private ?Client $emprunteur = null;

    #[ORM\ManyToOne(inversedBy: 'emprunts')]
    private ?Exemplaire $exemplaireEmprunte = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEmprunt(): ?\DateTimeInterface
    {
        return $this->dateEmprunt;
    }

    public function setDateEmprunt(?\DateTimeInterface $dateEmprunt): self
    {
        $this->dateEmprunt = $dateEmprunt;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->dateRetour;
    }

    public function setDateRetour(?\DateTimeInterface $dateRetour): self
    {
        $this->dateRetour = $dateRetour;

        return $this;
    }

    public function getCommentaires(): ?string
    {
        return $this->commentaires;
    }

    public function setCommentaires(?string $commentaires): self
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    public function getEmprunteur(): ?Client
    {
        return $this->emprunteur;
    }

    public function setEmprunteur(?Client $emprunteur): self
    {
        $this->emprunteur = $emprunteur;

        return $this;
    }

    public function getExemplaireEmprunte(): ?Exemplaire
    {
        return $this->exemplaireEmprunte;
    }

    public function setExemplaireEmprunte(?Exemplaire $exemplaireEmprunte): self
    {
        $this->exemplaireEmprunte = $exemplaireEmprunte;

        return $this;
    }
}
