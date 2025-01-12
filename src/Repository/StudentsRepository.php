<?php

namespace App\Repository;

use App\Entity\Students;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Students>
 */
class StudentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Students::class);
    }

    public function findBoarders(string $regime)
    {
        return $this->createQueryBuilder('s')
            ->join('s.regime', 'regime')
            ->andWhere('regime.name LIKE :searchTerm')
            ->setParameter('searchTerm', $regime.'%')
            ->addOrderBy('s.lastname', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findLike(string $query)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.firstname LIKE :searchTerm OR s.lastname LIKE :searchTerm')
            ->setParameter('searchTerm', $query.'%')
            ->addOrderBy('s.lastname', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Students[] Returns an array of Students objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Students
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
