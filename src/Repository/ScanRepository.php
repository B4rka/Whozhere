<?php

namespace App\Repository;

use App\Entity\Scan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Scan>
 */
class ScanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Scan::class);
    }

    public function findExits()
    {
        return $this->createQueryBuilder('s')
            ->join('s.student', 'students')
            ->andWhere('students.isIn = FALSE')
            ->addOrderBy('s.scannedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findEntries()
    {
        return $this->createQueryBuilder('s')
            ->join('s.student', 'students')
            ->andWhere('students.isIn = TRUE')
            ->addOrderBy('s.scannedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Scan[] Returns an array of Scan objects
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

    //    public function findOneBySomeField($value): ?Scan
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
