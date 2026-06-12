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

        $k = 0;
        for($i = 0; $i < 11; $i++){
            for($j = 0; $j < 3; $j++){
                if(random_int(0,1)) {
                    $cartLine = (new CartLine())
                        ->setCart($this->getReference('cart_' . $i, Cart::class))
                        ->setFood($this->getReference('food_' . rand(0,24), Food::class))
                        ->setQuantity(rand(1,5));
                    $this->addReference('cartLine_' . $k, $cartLine);
                    $k++;
                    $manager->persist($cartLine);
                }
            }
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
