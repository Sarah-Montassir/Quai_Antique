<?php

namespace App\Entity;

use App\Enum\DaysEnum;
use App\Repository\ScheduleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScheduleRepository::class)]
class Schedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, enumType: DaysEnum::class)]
    private ?DaysEnum $day = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $noonTimeStart = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $noonTimeEnd = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $eveningTimeStart = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $eveningTimeEnd = null;

    #[ORM\Column(options: ['default' => false])]
    private ?bool $isOpen = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?DaysEnum
    {
        return $this->day;
    }

    public function setDay(DaysEnum $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getNoonTimeStart(): ?\DateTimeInterface
    {
        return $this->noonTimeStart;
    }

    public function setNoonTimeStart(\DateTimeInterface $noonTimeStart): self
    {
        $this->noonTimeStart = $noonTimeStart;

        return $this;
    }

    public function getNoonTimeEnd(): ?\DateTimeInterface
    {
        return $this->noonTimeEnd;
    }

    public function setNoonTimeEnd(\DateTimeInterface $noonTimeEnd): self
    {
        $this->noonTimeEnd = $noonTimeEnd;

        return $this;
    }

    public function getEveningTimeStart(): ?\DateTimeInterface
    {
        return $this->eveningTimeStart;
    }

    public function setEveningTimeStart(\DateTimeInterface $eveningTimeStart): self
    {
        $this->eveningTimeStart = $eveningTimeStart;

        return $this;
    }

    public function getEveningTimeEnd(): ?\DateTimeInterface
    {
        return $this->eveningTimeEnd;
    }

    public function setEveningTimeEnd(\DateTimeInterface $eveningTimeEnd): self
    {
        $this->eveningTimeEnd = $eveningTimeEnd;

        return $this;
    }

    public function isIsOpen(): ?bool
    {
        return $this->isOpen;
    }

    public function setIsOpen(bool $isOpen): self
    {
        $this->isOpen = $isOpen;

        return $this;
    }

}
