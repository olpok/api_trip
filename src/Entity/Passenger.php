<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PassengerRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PassengerRepository::class)]
class Passenger
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['list_voyages'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['list_voyages'])]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    #[Groups(['list_voyages'])]
    private ?string $lastname = null;

    #[ORM\OneToMany(mappedBy: 'passenger', targetEntity: Voyage::class)]
    private Collection $voyages;

    public function __construct()
    {
        $this->voyages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return Collection<int, Voyage>
     */
    public function getVoyages(): Collection
    {
        return $this->voyages;
    }

    public function addVoyage(Voyage $voyage): self
    {
        if (!$this->voyages->contains($voyage)) {
            $this->voyages->add($voyage);
            $voyage->setPassenger($this);
        }

        return $this;
    }

    public function removeVoyage(Voyage $voyage): self
    {
        if ($this->voyages->removeElement($voyage)) {
            // set the owning side to null (unless already changed)
            if ($voyage->getPassenger() === $this) {
                $voyage->setPassenger(null);
            }
        }

        return $this;
    }
}
