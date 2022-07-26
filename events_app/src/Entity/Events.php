<?php

namespace App\Entity;

use App\Repository\EventsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventsRepository::class)]
class Events
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $event_name = null;

    #[ORM\Column(length: 255)]
    private ?string $event_description = null;

    #[ORM\Column]
    private ?int $expected_participants = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_event = null;

    #[ORM\Column]
    private ?bool $approval = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventName(): ?string
    {
        return $this->event_name;
    }

    public function setEventName(string $event_name): self
    {
        $this->event_name = $event_name;

        return $this;
    }

    public function getEventDescription(): ?string
    {
        return $this->event_description;
    }

    public function setEventDescription(string $event_description): self
    {
        $this->event_description = $event_description;

        return $this;
    }

    public function getExpectedParticipants(): ?int
    {
        return $this->expected_participants;
    }

    public function setExpectedParticipants(int $expected_participants): self
    {
        $this->expected_participants = $expected_participants;

        return $this;
    }

    public function getDateEvent(): ?\DateTimeInterface
    {
        return $this->date_event;
    }

    public function setDateEvent(\DateTimeInterface $date_event): self
    {
        $this->date_event = $date_event;

        return $this;
    }

    public function isApproval(): ?bool
    {
        return $this->approval;
    }

    public function setApproval(bool $approval): self
    {
        $this->approval = $approval;

        return $this;
    }
}
