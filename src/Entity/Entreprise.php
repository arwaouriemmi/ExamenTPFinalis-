<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Designation;

    #[ORM\OneToMany(mappedBy: 'Entreprise', targetEntity: Pfe::class)]
    private $Pfes;

    public function __construct()
    {
        $this->Pfes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->Designation;
    }

    public function setDesignation(string $Designation): self
    {
        $this->Designation = $Designation;

        return $this;
    }

    /**
     * @return Collection<int, Pfe>
     */
    public function getPfes(): Collection
    {
        return $this->Pfes;
    }

    public function addPfe(Pfe $pfe): self
    {
        if (!$this->Pfes->contains($pfe)) {
            $this->Pfes[] = $pfe;
            $pfe->setEntreprise($this);
        }

        return $this;
    }

    public function removePfe(Pfe $pfe): self
    {
        if ($this->Pfes->removeElement($pfe)) {
            // set the owning side to null (unless already changed)
            if ($pfe->getEntreprise() === $this) {
                $pfe->setEntreprise(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->Designation;
    }
}
