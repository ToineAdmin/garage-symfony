<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

#[ORM\HasLifecycleCallbacks]
trait CreatedAtTrait
{
    #[ORM\Column(type: 'datetime_immutable')]

    protected $created_at;


    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->create_at = new \DateTimeImmutable('now');
    }
}
