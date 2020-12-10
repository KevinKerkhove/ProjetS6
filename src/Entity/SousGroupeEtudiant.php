<?php

namespace App\Entity;

use App\Repository\SousGroupeEtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SousGroupeEtudiantRepository::class)
 */
class SousGroupeEtudiant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=SousGroupe::class)
     */
    private $sous_groupe;

    /**
     * @ORM\ManyToMany(targetEntity=Etudiant::class)
     */
    private $etudiant;

    public function __construct()
    {
        $this->sous_groupe = new ArrayCollection();
        $this->etudiant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|SousGroupe[]
     */
    public function getSousGroupe(): Collection
    {
        return $this->sous_groupe;
    }

    public function addSousGroupe(SousGroupe $sousGroupe): self
    {
        if (!$this->sous_groupe->contains($sousGroupe)) {
            $this->sous_groupe[] = $sousGroupe;
        }

        return $this;
    }

    public function removeSousGroupe(SousGroupe $sousGroupe): self
    {
        $this->sous_groupe->removeElement($sousGroupe);

        return $this;
    }

    /**
     * @return Collection|Etudiant[]
     */
    public function getEtudiant(): Collection
    {
        return $this->etudiant;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiant->contains($etudiant)) {
            $this->etudiant[] = $etudiant;
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        $this->etudiant->removeElement($etudiant);

        return $this;
    }
}
