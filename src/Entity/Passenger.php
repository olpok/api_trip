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
    #[Groups(['list_passengers'])] //['group1', 'group2']
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['list_passengers'])]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    #[Groups(['list_passengers'])]
    private ?string $lastname = null;

    #[ORM\OneToMany(mappedBy: 'passenger', targetEntity: BoardingPass::class)]
    #[Groups(['list_passengers', 'show_passenger'])]
    private Collection $boardingPasses;

    public function __construct()
    {
        $this->boardingPasses = new ArrayCollection();
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
            $boardingPass->setPassenger($this);
        }

        return $this;
    }

    public function removeBoardingPass(BoardingPass $boardingPass): self
    {
        if ($this->boardingPasses->removeElement($boardingPass)) {
            // set the owning side to null (unless already changed)
            if ($boardingPass->getPassenger() === $this) {
                $boardingPass->setPassenger(null);
            }
        }

        return $this;
    }
}
