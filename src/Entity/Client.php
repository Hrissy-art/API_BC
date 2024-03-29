<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;


#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ApiResource (normalizationContext:['groups'=>['clients:read']])]

class Client extends User
{

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['clients:read'])]

    private ?string $clientNumber = null;

    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'client')]
    #[Groups(['clients:read'])]

    private Collection $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

  

    public function getClientNumber(): ?string
    {
        return $this->clientNumber;
    }

    public function setClientNumber(?string $clientNumber): static
    {
        $this->clientNumber = $clientNumber;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setClient($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getClient() === $this) {
                $order->setClient(null);
            }
        }

        return $this;
    }
}
