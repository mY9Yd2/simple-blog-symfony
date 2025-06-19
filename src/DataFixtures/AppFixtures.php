<?php

namespace App\DataFixtures;

use App\Entity\Post;
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
        $admin->setEmail('bob@example.com');
        // Default: Admin1234
        $admin->setPassword('$2y$13$dFa7iqMg9WEZ/gXjFG1J0.1ZWgV3zLPnFKsIszUzo0/hADOdIH0tG');
        $admin->setTimezone('Europe/Budapest');
        $manager->persist($admin);

        $user = new User();
        $user->setUsername('Alice');
        $user->setEmail('alice@example.com');
        // Default: User1234
        $user->setPassword('$2y$13$Q0hKlk0f8AQJPn6Dk/HYN.UwddH4V/pzing4QatPzubvRQX4nvIy6');
        $user->setTimezone('Europe/Budapest');
        $manager->persist($user);

        for ($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post->setTitle('Post '.$i+1);
            $post->setBody('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod');
            $post->setAuthor($admin);
            $post->setPublishedAt(new \DateTimeImmutable());
            $manager->persist($post);
        }

        $manager->flush();
    }
}
