<?php

namespace App\Repository;

use App\Entity\AgenceLocation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AgenceLocation|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgenceLocation|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgenceLocation[]    findAll()
 * @method AgenceLocation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgentLocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgenceLocation::class);
    }

    // /**
    //  * @return AgenceLocation[] Returns an array of AgenceLocation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AgenceLocation
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
