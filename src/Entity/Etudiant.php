<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 */
class Etudiant
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
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datenaissance;

    /**
     * @ORM\ManyToMany(targetEntity=Ecole::class, inversedBy="etudiants")
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDatenaissance(): ?\DateTimeInterface
    {
        return $this->datenaissance;
    }

    public function setDatenaissance(\DateTimeInterface $datenaissance): self
    {
        $this->datenaissance = $datenaissance;

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
        }

        return $this;
    }

    public function removeEcoleid(ecole $ecoleid): self
    {
        $this->ecoleid->removeElement($ecoleid);

        return $this;
    }
}
