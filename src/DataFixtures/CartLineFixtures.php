<?php

namespace App\DataFixtures;

use App\Entity\Cart;
use App\Entity\CartLine;
use App\Entity\Food;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CartLineFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i = 0; $i < 5; $i++){
            $cartLine = new CartLine()
                ->setCart($this->getReference('cart_0', Cart::class))
                ->setFood($this->getReference('food_' . rand(0,25), Food::class))
                ->setQuantity(rand(1,5));
            $this->addReference('cartLine_' . $i, $cartLine);

            $manager->persist($cartLine);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CartFixtures::class,
            FoodFixtures::class,
        ];
    }
}
