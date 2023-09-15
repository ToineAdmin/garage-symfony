<?php

namespace App\Repository;

use App\Entity\Dou;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Dou>
 *
 * @method Dou|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dou|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dou[]    findAll()
 * @method Dou[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DouRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dou::class);
    }

//    /**
//     * @return Dou[] Returns an array of Dou objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Dou
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
