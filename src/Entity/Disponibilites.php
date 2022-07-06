<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DisponibilitesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DisponibilitesRepository::class)]
#[ApiResource]
class Disponibilites
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'time')]
    private $debut;

    #[ORM\Column(type: 'time')]
    private $fin;

    #[ORM\ManyToOne(targetEntity: Prestation::class, inversedBy: 'disponibilites')]
    #[ORM\JoinColumn(nullable: false)]
    private $prestation;

    #[ORM\OneToOne(mappedBy: 'disponibilite', targetEntity: Jour::class, cascade: ['persist', 'remove'])]
    private $jour;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(\DateTimeInterface $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(\DateTimeInterface $fin): self
    {
        $this->fin = $fin;

        return $this;
    }

    public function getPrestation(): ?Prestation
    {
        return $this->prestation;
    }

    public function setPrestation(?Prestation $prestation): self
    {
        $this->prestation = $prestation;

        return $this;
    }

    public function getJour(): ?Jour
    {
        return $this->jour;
    }

    public function setJour(Jour $jour): self
    {
        // set the owning side of the relation if necessary
        if ($jour->getDisponibilite() !== $this) {
            $jour->setDisponibilite($this);
        }

        $this->jour = $jour;

        return $this;
    }
}
