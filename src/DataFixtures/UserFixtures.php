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


        //only for me
        $baseUser = (new User())
            ->setUsername('lennart')
            ->setEmail('lennart.bauer@uni-muenster.de')
            ->setFirstName('Lennart')
            ->setLastName('Bauer');
        $baseUser->setPassword($this->passwordHasher->hashPassword($baseUser, '123'));
        $this->addReference('user_0', $baseUser);
        $manager->persist($baseUser);

        for($i = 1; $i < 11; $i++){
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
