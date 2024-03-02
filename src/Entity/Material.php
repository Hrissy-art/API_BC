<?php

namespace App\Entity;

use App\Repository\MaterialRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterialRepository::class)]
class Material
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $material_name = null;

    #[ORM\Column(nullable: true)]
    private ?float $coeff = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaterialName(): ?string
    {
        return $this->material_name;
    }

    public function setMaterialName(?string $material_name): static
    {
        $this->material_name = $material_name;

        return $this;
    }

    public function getCoeff(): ?float
    {
        return $this->coeff;
    }

    public function setCoeff(?float $coeff): static
    {
        $this->coeff = $coeff;

        return $this;
    }
}
