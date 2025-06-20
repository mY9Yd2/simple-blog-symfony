<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\Project;
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

        $limit = 10;

        for ($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post->setTitle('Post '.$limit-$i);
            $post->setBody('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod');
            $post->setAuthor($admin);
            $date = (new \DateTimeImmutable())->sub(new \DateInterval('P'.$i.'D'));
            $post->setPublishedAt($date);
            $post->setCreatedAt(\DateTime::createFromImmutable($date));
            $manager->persist($post);
        }

        for ($i = 0; $i < $limit; $i++) {
            $project = new Project();
            $project->setTitle('Project '.$limit-$i);
            $project->setDownloadUrl('#');
            $date = (new \DateTimeImmutable())->sub(new \DateInterval('P'.$i.'D'));
            $project->setPublishedAt($date);
            $project->setCreatedAt(\DateTime::createFromImmutable($date));
            $manager->persist($project);
        }

        $manager->flush();
    }
}
