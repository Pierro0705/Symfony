<?php

namespace App\Repository;

use App\Entity\Typeproprietaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Typeproprietaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Typeproprietaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Typeproprietaire[]    findAll()
 * @method Typeproprietaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeproprietaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Typeproprietaire::class);
    }

    // /**
    //  * @return Typeproprietaire[] Returns an array of Typeproprietaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Typeproprietaire
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
