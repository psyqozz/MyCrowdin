<?php

namespace App\Repository;

use App\Entity\Translater;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Translater|null find($id, $lockMode = null, $lockVersion = null)
 * @method Translater|null findOneBy(array $criteria, array $orderBy = null)
 * @method Translater[]    findAll()
 * @method Translater[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TranslaterRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Translater::class);
    }

    // /**
    //  * @return Translater[] Returns an array of Translater objects
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
    public function findOneBySomeField($value): ?Translater
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
