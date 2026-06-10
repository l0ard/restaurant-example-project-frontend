<?php

namespace App\Entity;

use App\Repository\FoodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: FoodRepository::class)]
class Food
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $imageUrl = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price = null;

    #[ORM\Column]
    private ?int $stars = null;

    #[ORM\Column(length: 255)]
    private ?string $cookTime = null;

    #[ORM\Column]
    private ?bool $favorite = null;

    /**
     * @var Collection<int, Tag>
     */
    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'foods')]
    private Collection $tags;

    /**
     * @var Collection<int, Origin>
     */
    #[ORM\ManyToMany(targetEntity: Origin::class, inversedBy: 'foods')]
    private Collection $origins;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->origins = new ArrayCollection();
    }

    #[Groups(['food:read', 'cart:read'])]
    public function getId(): ?int
    {
        return $this->id;
    }

    #[Groups(['food:read', 'cart:read'])]
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    #[Groups(['food:read'])]
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    #[Groups(['food:read', 'cart:read'])]
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    #[Groups(['food:read', 'cart:read'])]
    public function getPrice(): ?float
    {
        return (float)$this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    #[Groups(['food:read'])]
    public function getStars(): ?int
    {
        return $this->stars;
    }

    public function setStars(int $stars): static
    {
        $this->stars = $stars;

        return $this;
    }

    #[Groups(['food:read'])]
    public function getCookTime(): ?string
    {
        return $this->cookTime;
    }

    public function setCookTime(string $cookTime): static
    {
        $this->cookTime = $cookTime;

        return $this;
    }

    #[Groups(['food:read'])]
    public function isFavorite(): ?bool
    {
        return $this->favorite;
    }

    public function setFavorite(bool $favorite): static
    {
        $this->favorite = $favorite;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    #[Groups(['food:read'])]
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    /**
     * @return Collection<int, Origin>
     */
    #[Groups(['food:read'])]
    public function getOrigins(): Collection
    {
        return $this->origins;
    }

    public function addOrigin(Origin $origin): static
    {
        if (!$this->origins->contains($origin)) {
            $this->origins->add($origin);
        }

        return $this;
    }

    public function removeOrigin(Origin $origin): static
    {
        $this->origins->removeElement($origin);

        return $this;
    }
}
