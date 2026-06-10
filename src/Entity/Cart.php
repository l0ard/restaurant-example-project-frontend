<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, CartLine>
     */
    #[ORM\OneToMany(targetEntity: CartLine::class, mappedBy: 'cart', orphanRemoval: true)]
    private Collection $cartLines;

    public function __construct()
    {
        $this->cartLines = new ArrayCollection();
    }

    #[Groups('cart:read')]
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return array<int, CartLine>
     */
    #[Groups('cart:read')]
    public function getCartLines(): array
    {
        return array_values($this->cartLines->toArray());
    }

    public function addCartLine(CartLine $cartLine): static
    {
        if (!$this->cartLines->contains($cartLine)) {
            $this->cartLines->add($cartLine);
            $cartLine->setCart($this);
        }

        return $this;
    }

    public function removeCartLine(CartLine $cartLine): static
    {
        if ($this->cartLines->removeElement($cartLine)) {
            // set the owning side to null (unless already changed)
            if ($cartLine->getCart() === $this) {
                $cartLine->setCart(null);
            }
        }

        return $this;
    }

    #[Groups(['cart:read'])]
    public function getTotalPrice(): float
    {
        return round(
            array_reduce(
            $this->cartLines->toArray(),
            fn ($sum, CartLine $line) =>
                $sum + $line->getLinePrice(),
            0
        ));
    }

    #[Groups(['cart:read'])]
    public function getTotalCount(): int
    {
        return array_reduce(
            $this->cartLines->toArray(),
            fn ($sum, CartLine $line) =>
                $sum + $line->getQuantity(),
            0
        );
    }
}
