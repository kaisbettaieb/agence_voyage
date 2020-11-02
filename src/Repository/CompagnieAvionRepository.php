<?php

namespace App\Repository;

use App\Entity\CompagnieAvion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompagnieAvion|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompagnieAvion|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompagnieAvion[]    findAll()
 * @method CompagnieAvion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompagnieAvionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompagnieAvion::class);
    }

    // /**
    //  * @return CompagnieAvion[] Returns an array of CompagnieAvion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CompagnieAvion
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
