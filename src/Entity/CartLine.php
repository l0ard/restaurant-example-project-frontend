<?php

namespace App\Entity;

use App\Repository\CartLineRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CartLineRepository::class)]
class CartLine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Food $food = null;

    #[ORM\ManyToOne(inversedBy: 'cartLines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cart $cart = null;

    #[Groups('cart:read')]
    public function getId(): ?int
    {
        return $this->id;
    }

    #[Groups('cart:read')]
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    #[Groups('cart:read')]
    public function getFood(): ?Food
    {
        return $this->food;
    }

    public function setFood(?Food $food): static
    {
        $this->food = $food;

        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): static
    {
        $this->cart = $cart;

        return $this;
    }

    #[Groups(['cart:read'])]
    public function getLinePrice(): float
    {
        return round(
            (float)$this->food->getPrice() * $this->quantity, 2
        );
    }
}
