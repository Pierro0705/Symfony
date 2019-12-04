<?php

namespace App\Repository;

use App\Entity\Bien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Bien|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bien|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bien[]    findAll()
 * @method Bien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bien::class);
    }

    // /**
    //  * @return Bien[] Returns an array of Bien objects
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
    public function findOneBySomeField($value): ?Bien
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function rechercheBien($ville,$nbPlaces,$superficieMin,$superficieMax,$typeBien,$dateArrivee,$dateDepart): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT b.id, b.adressebien, b.superficiebien, b.prixparnuit, b.nbplaces, b.description, b.image, v.nomville, tb.libelle
            FROM App\Entity\Bien b
            INNER JOIN b.ville v
            INNER JOIN b.typebien tb
            LEFT JOIN b.louers l
            WHERE tb.libelle = :typebien
            AND ((:dateArrivee < l.datearrivee AND :dateDepart < l.datearrivee)
            OR l.id IS NULL)
            AND b.nbplaces >= :nbPlaces
            AND b.ville = v.id
            AND v.nomville like '%" . $ville . "%'
            AND b.superficiebien BETWEEN :superficieMin AND :superficieMax
    "
        )->setParameter('typebien',$typeBien)
         ->setParameter('dateArrivee',$dateArrivee)
         ->setParameter('dateDepart',$dateDepart)
         ->setParameter('nbPlaces',$nbPlaces)
         ->setParameter('superficieMin',$superficieMin)
         ->setParameter('superficieMax',$superficieMax);

        
        return $query->getResult();
    }
    
    public function bienRandom(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT b.adressebien, b.superficiebien, b.prixparnuit, b.nbplaces, b.description, b.image, v.nomville, tb.libelle
            FROM App\Entity\Bien b, App\Entity\Ville v, App\Entity\Typebien tb
            WHERE b.ville IN (SELECT v.id from App\Entity\Ville ville where ville.nomville like '%')
            AND b.typebien IN (SELECT tb.id from App\Entity\Typebien typebien where typebien.libelle like '%')
            AND b.nbplaces >= 3
            AND b.superficiebien BETWEEN 10 AND 400
            ORDER BY Rand()"
            )->setMaxResults(6);

        return $query->getResult();
    }
}
