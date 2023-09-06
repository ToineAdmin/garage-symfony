<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Repository\FeedbackRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FeedbackRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Feedback
{

    use CreatedAtTrait;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 3,
        max: 15,
        minMessage: 'Votre Prénom doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Votre Prénom doit contenir au maximum {{ limit }} caractères',
    )]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\Length(
        min: 8,
        max: 500,
        minMessage: 'Votre message doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Votre message doit contenir au maximum {{ limit }} caractères',
    )]
    private ?string $comment = null;

    #[ORM\Column]
    #[Assert\Range(
        min: 0,
        max: 5,
        notInRangeMessage: 'La note doit être entre {{ min }} et {{ max }}',
    )]
    private ?float $rating = null;

    #[ORM\Column]
    private ?bool $approved = false;
    

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

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(float $rating): static
    {
        $this->rating = $rating;

        return $this;
    }


    public function isApproved(): ?bool
    {
        return $this->approved;
    }

    public function setApproved(bool $approuved): static
    {
        $this->approved = $approuved;

        return $this;
    }

}
