<?php

namespace App\Entity;

use App\Repository\OpeningHourRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpeningHourRepository::class)]
class OpeningHour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $day = null;

    #[ORM\Column]
    private ?bool $isClosed = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $morningOpeningTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $morningClosingTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $afternoonOpeningTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $afternoonClosingTime = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): static
    {
        $this->day = $day;

        return $this;
    }


    public function isIsClosed(): ?bool
    {
        return $this->isClosed;
    }

    public function setIsClosed(bool $isClosed): static
    {
        $this->isClosed = $isClosed;

        return $this;
    }

    public function getMorningOpeningTime(): ?\DateTimeInterface
    {
        return $this->morningOpeningTime;
    }

    public function setMorningOpeningTime(?\DateTimeInterface $morningOpeningTime): static
    {
        $this->morningOpeningTime = $morningOpeningTime;

        return $this;
    }

    public function getMorningClosingTime(): ?\DateTimeInterface
    {
        return $this->morningClosingTime;
    }

    public function setMorningClosingTime(?\DateTimeInterface $morningClosingTime): static
    {
        $this->morningClosingTime = $morningClosingTime;

        return $this;
    }

    public function getAfternoonOpeningTime(): ?\DateTimeInterface
    {
        return $this->afternoonOpeningTime;
    }

    public function setAfternoonOpeningTime(?\DateTimeInterface $afternoonOpeningTime): static
    {
        $this->afternoonOpeningTime = $afternoonOpeningTime;

        return $this;
    }

    public function getAfternoonClosingTime(): ?\DateTimeInterface
    {
        return $this->afternoonClosingTime;
    }

    public function setAfternoonClosingTime(?\DateTimeInterface $afternoonClosingTime): static
    {
        $this->afternoonClosingTime = $afternoonClosingTime;

        return $this;
    }
}
