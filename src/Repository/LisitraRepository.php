<?php

namespace App\Repository;

use App\Entity\Lisitra;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lisitra|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lisitra|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lisitra[]    findAll()
 * @method Lisitra[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LisitraRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lisitra::class);
    }

    // /**
    //  * @return Lisitra[] Returns an array of Lisitra objects
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
    public function findOneBySomeField($value): ?Lisitra
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
