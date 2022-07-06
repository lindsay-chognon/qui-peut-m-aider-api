<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PrestationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrestationRepository::class)]
#[ApiResource]
class Prestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $photo;

    #[ORM\Column(type: 'float')]
    private $taux_horaire;

    #[ORM\Column(type: 'integer')]
    private $statut;

    #[ORM\OneToMany(mappedBy: 'prestation', targetEntity: Disponibilites::class, orphanRemoval: true)]
    private $disponibilites;

    #[ORM\OneToMany(mappedBy: 'prestation', targetEntity: Jour::class, orphanRemoval: true)]
    private $jours;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'prestations')]
    #[ORM\JoinColumn(nullable: false)]
    private $categorie;

    #[ORM\OneToMany(mappedBy: 'prestation', targetEntity: Reservation::class, orphanRemoval: true)]
    private $reservations;

    public function __construct()
    {
        $this->disponibilites = new ArrayCollection();
        $this->jours = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getTauxHoraire(): ?float
    {
        return $this->taux_horaire;
    }

    public function setTauxHoraire(float $taux_horaire): self
    {
        $this->taux_horaire = $taux_horaire;

        return $this;
    }

    public function getStatut(): ?int
    {
        return $this->statut;
    }

    public function setStatut(int $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection<int, Disponibilites>
     */
    public function getDisponibilites(): Collection
    {
        return $this->disponibilites;
    }

    public function addDisponibilite(Disponibilites $disponibilite): self
    {
        if (!$this->disponibilites->contains($disponibilite)) {
            $this->disponibilites[] = $disponibilite;
            $disponibilite->setPrestation($this);
        }

        return $this;
    }

    public function removeDisponibilite(Disponibilites $disponibilite): self
    {
        if ($this->disponibilites->removeElement($disponibilite)) {
            // set the owning side to null (unless already changed)
            if ($disponibilite->getPrestation() === $this) {
                $disponibilite->setPrestation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Jour>
     */
    public function getJours(): Collection
    {
        return $this->jours;
    }

    public function addJour(Jour $jour): self
    {
        if (!$this->jours->contains($jour)) {
            $this->jours[] = $jour;
            $jour->setPrestation($this);
        }

        return $this;
    }

    public function removeJour(Jour $jour): self
    {
        if ($this->jours->removeElement($jour)) {
            // set the owning side to null (unless already changed)
            if ($jour->getPrestation() === $this) {
                $jour->setPrestation(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setPrestation($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getPrestation() === $this) {
                $reservation->setPrestation(null);
            }
        }

        return $this;
    }
}
