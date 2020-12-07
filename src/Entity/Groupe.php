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
     * @ORM\ManyToOne(targetEntity=Groupe::class, inversedBy="sous_groupes")
     */
    private $groupe;

    /**
     * @ORM\OneToMany(targetEntity=Groupe::class, mappedBy="groupe")
     */
    private $sous_groupes;

    public function __construct()
    {
        $this->sous_groupes = new ArrayCollection();
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

    public function getGroupe(): ?self
    {
        return $this->groupe;
    }

    public function setGroupe(?self $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSousGroupes(): Collection
    {
        return $this->sous_groupes;
    }

    public function addGroupe(self $groupe): self
    {
        if (!$this->sous_groupes->contains($groupe)) {
            $this->sous_groupes[] = $groupe;
            $groupe->setGroupe($this);
        }

        return $this;
    }

    public function removeGroupe(self $groupe): self
    {
        if ($this->sous_groupes->removeElement($groupe)) {
            // set the owning side to null (unless already changed)
            if ($groupe->getGroupe() === $this) {
                $groupe->setGroupe(null);
            }
        }

        return $this;
    }
}
