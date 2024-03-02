<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OrderProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: OrderProductRepository::class)]
#[ApiResource(normalizationContext:['groups'=>['orderProduct:read']])]

class OrderProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['orderProduct:read'])]

    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'orderProducts')]

    private ?product $product = null;

    #[ORM\ManyToOne(inversedBy: 'orderProducts')]

    private ?material $material = null;

    #[ORM\ManyToOne(inversedBy: 'orderProducts')]
    private ?order $order_product = null;


    #[ORM\ManyToOne(inversedBy: 'orderProducts')]

    private ?qualityProduct $quality_product = null;

    #[ORM\ManyToOne(inversedBy: 'orderProducts')]

    private ?status $status_order = null;

    #[ORM\ManyToOne(inversedBy: 'orderProducts')]

    private ?service $service = null;

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

    public function getProduct(): ?product
    {
        return $this->product;
    }

    public function setProduct(?product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getMaterial(): ?material
    {
        return $this->material;
    }

    public function setMaterial(?material $material): static
    {
        $this->material = $material;

        return $this;
    }

    public function getOrderProduct(): ?order
    {
        return $this->order_product;
    }

    public function setOrderProduct(?order $order_product): static
    {
        $this->order_product = $order_product;

        return $this;
    }

    public function getQualityProduct(): ?qualityProduct
    {
        return $this->quality_product;
    }

    public function setQualityProduct(?qualityProduct $quality_product): static
    {
        $this->quality_product = $quality_product;

        return $this;
    }

    public function getStatusOrder(): ?status
    {
        return $this->status_order;
    }

    public function setStatusOrder(?status $status_order): static
    {
        $this->status_order = $status_order;

        return $this;
    }

    public function getService(): ?service
    {
        return $this->service;
    }

    public function setService(?service $service): static
    {
        $this->service = $service;

        return $this;
    }
}
