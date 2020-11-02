<?php

namespace App\Repository;

use App\Entity\LocationChambre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LocationChambre|null find($id, $lockMode = null, $lockVersion = null)
 * @method LocationChambre|null findOneBy(array $criteria, array $orderBy = null)
 * @method LocationChambre[]    findAll()
 * @method LocationChambre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationChambreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LocationChambre::class);
    }

    // /**
    //  * @return LocationChambre[] Returns an array of LocationChambre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LocationChambre
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
