<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\VoyageRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: VoyageRepository::class)]
class Voyage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['list_voyages'])] //['group1', 'group2']
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'voyages')]
    #[Groups(['list_voyages'])]
    private ?Passenger $passenger = null;

    #[ORM\OneToMany(mappedBy: 'voyage', targetEntity: BoardingPass::class)]
    #[Groups(['list_voyages', 'show_voyage'])]
    private Collection $boardingPasses;

    public function __construct()
    {
        $this->boardingPasses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getPassenger(): ?Passenger
    {
        return $this->passenger;
    }

    public function setPassenger(?Passenger $passenger): self
    {
        $this->passenger = $passenger;

        return $this;
    }

    /**
     * @return Collection<int, BoardingPass>
     */
    public function getBoardingPasses(): Collection
    {
        return $this->boardingPasses;
    }

    public function addBoardingPass(BoardingPass $boardingPass): self
    {
        if (!$this->boardingPasses->contains($boardingPass)) {
            $this->boardingPasses->add($boardingPass);
            $boardingPass->setVoyage($this);
        }

        return $this;
    }

    public function removeBoardingPass(BoardingPass $boardingPass): self
    {
        if ($this->boardingPasses->removeElement($boardingPass)) {
            // set the owning side to null (unless already changed)
            if ($boardingPass->getVoyage() === $this) {
                $boardingPass->setVoyage(null);
            }
        }

        return $this;
    }
}
