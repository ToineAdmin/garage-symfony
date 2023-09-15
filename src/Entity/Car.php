<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Repository\CarRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CarRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Car
{

    use CreatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $brand = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 255)]
    private ?string $miles = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $caracteristics = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $equipements = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::JSON)]
    private array $image = [];

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[ORM\JoinColumn(name: 'created_by_id', referencedColumnName: 'id' , nullable: false)]
    private ?User $createdBy = null;


    #[ORM\Column(length: 255)]
    private ?string $fuel = null;

    #[ORM\Column(type: "integer")]
    #[Assert\Range(
        min: 1995,
        max: "now",
        notInRangeMessage: 'Vous devez entrer une année entre {{ min }} et {{ max }}',
    )]
    private ?int $year = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }


    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getMiles(): ?string
    {
        return $this->miles;
    }

    public function setMiles(string $miles): static
    {
        $this->miles = $miles;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCaracteristics(): ?string
    {
        return $this->caracteristics;
    }

    public function setCaracteristics(string $caracteristics): static
    {
        $this->caracteristics = $caracteristics;

        return $this;
    }

    public function getEquipements(): ?string
    {
        return $this->equipements;
    }

    public function setEquipements(string $equipements): static
    {
        $this->equipements = $equipements;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }


    public function getImage(): ?array
    {
        return $this->image;
    }

    public function setImage(array $image): static
    {
        $this->image = $image;

        return $this;
    }


    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): static
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }
    
    public function setYear(int $year): static
    {
        $this->year = $year;
        return $this;
    }

    public function getFuel(): ?string
    {
        return $this->fuel;
    }

    public function setFuel(string $fuel): static
    {
        $this->fuel = $fuel;

        return $this;
    }
}
