<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Project>
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    public function createPublishedQuery(\DateTimeInterface $endDate, ?string $search = null): Query
    {
        $query = $this->createQueryBuilder('p')
            ->andWhere('p.publishedAt <= :endDate')
            ->setParameter('endDate', $endDate)
            ->orderBy('p.publishedAt', 'DESC');

        if ($search) {
            $query->andWhere('p.title LIKE :search')
                ->setParameter('search', '%'.$search.'%');
        }

        return $query->getQuery();
    }
}
