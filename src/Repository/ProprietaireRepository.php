<?php

namespace App\Repository;

use App\Entity\Proprietaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Proprietaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Proprietaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Proprietaire[]    findAll()
 * @method Proprietaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProprietaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Proprietaire::class);
    }

    // /**
    //  * @return Proprietaire[] Returns an array of Proprietaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Proprietaire
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function verifProprietaire($mail,$mdp): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT count(p.mailproprietaire)
            FROM App\Entity\Proprietaire p
            WHERE p.mailproprietaire = :mail
            AND p.mdpproprietaire = :mdp'
        )->setParameter('mail', $mail)
         ->setParameter('mdp', $mdp);

        // returns an array of Product objects
        return $query->getResult();
    }

    public function getLocations($mail): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT l.datearrivee, l.datedepart, l.prix, b.adressebien, l.id
            FROM App\Entity\Proprietaire p, App\Entity\Bien b, App\Entity\Louer l
            WHERE p.id = b.proprietaire
            AND b.id = l.bien
            AND l.status = 'En attente'
            AND p.mailproprietaire = :mail"
        )->setParameter('mail', $mail);

        // returns an array of Product objects
        return $query->getResult();
    }
}
