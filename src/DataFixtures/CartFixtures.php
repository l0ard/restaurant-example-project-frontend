<?php

namespace App\DataFixtures;

use App\Entity\Cart;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CartFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 11; $i++){
            $cart = new Cart();
            $cart
                ->setUser($this->getReference('user_'. $i, User::class));
            $this->addReference('cart_' . $i, $cart);

            $manager->persist($cart);
        }

        $manager->persist($cart);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
