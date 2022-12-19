<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BoardingPassRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BoardingPassRepository::class)]
class BoardingPass
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['show_passenger'])]
    private ?string $transport_type = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['show_passenger'])]
    private ?string $transport_number = null;

    #[ORM\Column(length: 255)]
    #[Groups(['show_passenger'])]
    private ?string $origin = null;

    #[ORM\Column(length: 255)]
    #[Groups(['show_passenger'])]
    private ?string $destination = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['show_passenger'])]
    private ?string $gate = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['show_passenger'])]
    private ?string $seat = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['show_passenger'])]
    private ?string $baggage_info = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $departure_time = null;

    #[ORM\ManyToOne(inversedBy: 'boardingPasses')]
    private ?Passenger $passenger = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTransportType(): ?string
    {
        return $this->transport_type;
    }

    public function setTransportType(string $transport_type): self
    {
        $this->transport_type = $transport_type;

        return $this;
    }

    public function getTransportNumber(): ?string
    {
        return $this->transport_number;
    }

    public function setTransportNumber(string $transport_number): self
    {
        $this->transport_number = $transport_number;

        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(string $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getGate(): ?string
    {
        return $this->gate;
    }

    public function setGate(?string $gate): self
    {
        $this->gate = $gate;

        return $this;
    }
    public function getSeat(): ?string
    {
        return $this->seat;
    }

    public function setSeat(?string $seat): self
    {
        $this->seat = $seat;

        return $this;
    }

    public function getBaggageInfo(): ?string
    {
        return $this->baggage_info;
    }

    public function setBaggageInfo(?string $baggage_info): self
    {
        $this->baggage_info = $baggage_info;

        return $this;
    }

    public function getDepartureTime(): ?\DateTimeInterface
    {
        return $this->departure_time;
    }

    public function setDepartureTime(\DateTimeInterface $departure_time): self
    {
        $this->departure_time = $departure_time;

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
}
