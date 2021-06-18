<?php

namespace App\Repository;

use App\Entity\InternalDocuments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InternalDocuments|null find($id, $lockMode = null, $lockVersion = null)
 * @method InternalDocuments|null findOneBy(array $criteria, array $orderBy = null)
// * @method InternalDocuments[]    findAll()
 * @method InternalDocuments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InternalDocumentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InternalDocuments::class);
    }

     /**
      * @return InternalDocuments[] Returns an array of InternalDocuments objects
      */
    public function findAll()
    {
        return $this->findBy(array(), array('name' => 'ASC'));
    }

    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InternalDocuments
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
