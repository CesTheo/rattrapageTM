<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
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
     * @ORM\OneToMany(targetEntity=Ecole::class, mappedBy="ville")
     */
    private $ecoleid;

    public function __construct()
    {
        $this->ecoleid = new ArrayCollection();
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

    /**
     * @return Collection|ecole[]
     */
    public function getEcoleid(): Collection
    {
        return $this->ecoleid;
    }

    public function addEcoleid(ecole $ecoleid): self
    {
        if (!$this->ecoleid->contains($ecoleid)) {
            $this->ecoleid[] = $ecoleid;
            $ecoleid->setVille($this);
        }

        return $this;
    }

    public function removeEcoleid(ecole $ecoleid): self
    {
        if ($this->ecoleid->removeElement($ecoleid)) {
            // set the owning side to null (unless already changed)
            if ($ecoleid->getVille() === $this) {
                $ecoleid->setVille(null);
            }
        }

        return $this;
    }
}
