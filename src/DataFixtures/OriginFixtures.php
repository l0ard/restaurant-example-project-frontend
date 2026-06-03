<?php

namespace App\DataFixtures;

use App\Entity\Origin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class OriginFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i = 0; $i < 20; $i++){
            $origin = new Origin();
            $origin->setName($faker->unique()->country());
            $this->addReference('origin_' . $i, $origin);

            $manager->persist($origin);
        }

        $manager->flush();
    }
}
