<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Service\UserRegisterService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $faker;
    private UserPasswordHasherInterface $hasher;


    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $this->faker = Factory::create();
        $userRepository = $manager->getRepository(User::class);
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $username = $this->faker->userName;
            $userAlreadyExists = $userRepository->findBy(['username' => $username]);
            if($userAlreadyExists) {
                continue;
            }
            $user->setUsername($username);
            $user->setPassword($this->faker->password);
            $this->hashUserPassword($user);
            $manager->persist($user);
        }
        $manager->flush();
    }

    private function hashUserPassword(User $user): void
    {
        $hashedPassword = $this->hasher->hashPassword(
            $user,
            $user->getPassword()
        );
        $user->setPassword($hashedPassword);
    }
}
