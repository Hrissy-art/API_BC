<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OrderProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: OrderProductRepository::class)]
#[ApiResource]

class OrderProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
   

    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'orderProducts')]

    private ?Product $product = null;

    #[ORM\ManyToOne(inversedBy: 'orderProducts')]

    private ?Material $material = null;

    #[ORM\ManyToOne(inversedBy: 'orderProducts')]
    private ?Order $order_product = null;


    #[ORM\ManyToOne(inversedBy: 'orderProducts')]

    private ?QualityProduct $quality_product = null;

    #[ORM\ManyToOne(inversedBy: 'orderProducts')]

    private ?Status $status_order = null;

    #[ORM\ManyToOne(inversedBy: 'orderProducts')]

    private ?Service $service = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getMaterial(): ?Material
    {
        return $this->material;
    }

    public function setMaterial(?Material $material): static
    {
        $this->material = $material;

        return $this;
    }

    public function getOrderProduct(): ?Order
    {
        return $this->order_product;
    }

    public function setOrderProduct(?Order $order_product): static
    {
        $this->order_product = $order_product;

        return $this;
    }

    public function getQualityProduct(): ?QualityProduct
    {
        return $this->quality_product;
    }

    public function setQualityProduct(?QualityProduct $quality_product): static
    {
        $this->quality_product = $quality_product;

        return $this;
    }

    public function getStatusOrder(): ?Status
    {
        return $this->status_order;
    }

    public function setStatusOrder(?Status $status_order): static
    {
        $this->status_order = $status_order;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): static
    {
        $this->service = $service;

        return $this;
    }
}
