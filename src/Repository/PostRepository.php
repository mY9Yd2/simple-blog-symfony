<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function createPublishedQuery(\DateTimeInterface $endDate, ?string $search = null): Query
    {
        $query = $this->createQueryBuilder('p')
            ->andWhere('p.publishedAt <= :endDate')
            ->setParameter('endDate', $endDate)
            ->orderBy('p.publishedAt', 'DESC');

        if ($search) {
            $query->andWhere('p.title LIKE :search OR p.body LIKE :search')
                ->setParameter('search', '%'.$search.'%');
        }

        return $query->getQuery();
    }
}
