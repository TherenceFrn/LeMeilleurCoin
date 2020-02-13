<?php

namespace App\Repository;

use App\Entity\Favorits;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Favorits|null find($id, $lockMode = null, $lockVersion = null)
 * @method Favorits|null findOneBy(array $criteria, array $orderBy = null)
 * @method Favorits[]    findAll()
 * @method Favorits[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavoritsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Favorits::class);
    }

    // /**
    //  * @return Favorits[] Returns an array of Favorits objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Favorits
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
