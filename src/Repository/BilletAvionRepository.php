<?php

namespace App\Repository;

use App\Entity\BilletAvion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BilletAvion|null find($id, $lockMode = null, $lockVersion = null)
 * @method BilletAvion|null findOneBy(array $criteria, array $orderBy = null)
 * @method BilletAvion[]    findAll()
 * @method BilletAvion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BilletAvionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BilletAvion::class);
    }

    // /**
    //  * @return BilletAvion[] Returns an array of BilletAvion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BilletAvion
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
