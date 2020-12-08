<?php

namespace App\Entity;

use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupeRepository::class)
 */
class Groupe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity=Promotion::class, inversedBy="groupes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $promotion;

    /**
     * @ORM\OneToMany(targetEntity=SousGroupe::class, mappedBy="groupe")
     */
    private $sousGroupes;


    public function __construct()
    {
        $this->sousGroupes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPromotion(): ?Promotion
    {
        return $this->promotion;
    }

    public function setPromotion(?Promotion $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }

    /**
     * @return Collection|SousGroupe[]
     */
    public function getSousGroupes(): Collection
    {
        return $this->sousGroupes;
    }

    public function addSousGroupe(SousGroupe $sousGroupe): self
    {
        if (!$this->sousGroupes->contains($sousGroupe)) {
            $this->sousGroupes[] = $sousGroupe;
            $sousGroupe->setGroupe($this);
        }

        return $this;
    }

    public function removeSousGroupe(SousGroupe $sousGroupe): self
    {
        if ($this->sousGroupes->removeElement($sousGroupe)) {
            // set the owning side to null (unless already changed)
            if ($sousGroupe->getGroupe() === $this) {
                $sousGroupe->setGroupe(null);
            }
        }

        return $this;
    }
}
