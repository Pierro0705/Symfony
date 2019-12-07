<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    // /**
    //  * @return Client[] Returns an array of Client objects
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

    
    public function findOneBySomeField($mail): ?Client
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.mail = :mail')
            ->setParameter('mail', $mail)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    

    public function verifClient($mail,$mdp): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT count(c.mail)
            FROM App\Entity\Client c
            WHERE c.mail = :mail
            AND c.mdp = :mdp'
        )->setParameter('mail', $mail)
         ->setParameter('mdp', $mdp);

        // returns an array of Product objects
        return $query->getResult();
    }

    public function getIdClientByMail($mail)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c.id
            FROM App\Entity\Client c
            WHERE c.mail = :mail'
        )->setParameter('mail', $mail);

        // returns an array of Product objects
        return $query->getSingleScalarResult();
    }
}
