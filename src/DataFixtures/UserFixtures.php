<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i = 0; $i < 10; $i++){
            $user = new User();
            $user
                ->setUsername($faker->unique()->word())
                ->setFirstName($faker->firstName())
                ->setLastName($faker->lastName());
            $user->setEmail($user->getFirstName() . '_' . $user->getLastName() . '@' . $faker->word() . ".de");
            $user->setPassword($this->passwordHasher->hashPassword($user, $user->getFirstName()));
            $this->addReference('user_' . $i, $user);

            $manager->persist($user);
        }
        $manager->flush();
    }
}
