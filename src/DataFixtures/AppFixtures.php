<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setUsername('Bob');
        // Default: Admin1234
        $admin->setPassword('$2y$13$dFa7iqMg9WEZ/gXjFG1J0.1ZWgV3zLPnFKsIszUzo0/hADOdIH0tG');
        $manager->persist($admin);

        $user = new User();
        $user->setUsername('Alice');
        // Default: User1234
        $user->setPassword('$2y$13$Q0hKlk0f8AQJPn6Dk/HYN.UwddH4V/pzing4QatPzubvRQX4nvIy6');
        $manager->persist($user);

        $manager->flush();
    }
}
