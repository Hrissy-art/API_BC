<?php

namespace App\Entity;

use App\Repository\QualityProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QualityProductRepository::class)]
class QualityProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status_name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatusName(): ?string
    {
        return $this->status_name;
    }

    public function setStatusName(?string $status_name): static
    {
        $this->status_name = $status_name;

        return $this;
    }
}
