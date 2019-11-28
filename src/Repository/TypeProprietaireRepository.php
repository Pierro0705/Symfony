<?php

namespace App\Repository;

use App\Entity\TypeProprietaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeProprietaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeProprietaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeProprietaire[]    findAll()
 * @method TypeProprietaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeProprietaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeProprietaire::class);
    }

    // /**
    //  * @return TypeProprietaire[] Returns an array of TypeProprietaire objects
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
    public function findOneBySomeField($value): ?TypeProprietaire
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
