<?php

namespace App\DataFixtures;

use App\Entity\Food;
use App\Entity\Origin;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class FoodFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i = 0; $i < 25; $i++){
            $food = (new Food())
                ->setName($faker->unique()->word())
                ->setDescription($faker->realText(254))
                ->setCookTime($faker->numberBetween(10,30) . '-' . $faker->numberBetween(35,60))
                ->setImageUrl('assets/images/foods/food-' . $faker->numberBetween(1,6) . '.jpg')
                ->setPrice($faker->randomFloat(2, 5, 50))
                ->setStars($faker->numberBetween(0,5))
                ->setFavorite($faker->boolean(50));
            for($j = 0; $j < rand(1,3); $j++){
                $food->addOrigin($this->getReference('origin_' . rand(0, 19), Origin::class));
            }
            for($j = 0; $j < rand(1,3); $j++){
                $food->addTag($this->getReference('tag_' . rand(0, 11), Tag::class));
            }
            $this->addReference('food_' . $i, $food);
            $manager->persist($food);
        }

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            TagFixtures::class,
            OriginFixtures::class,
        ];
    }
}
