<?php

namespace App\Repository;

use App\Entity\Car;
use App\Data\SearchData;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Car::class);
        $this->paginator = $paginator;
    }

    public function findSearch(SearchData $search) : PaginationInterface
    {
        $query = $this->createQueryBuilder('c');
    
        if (!empty($search->q)){
            $query = $query
                ->andWhere('c.name LIKE :q')
                ->setParameter('q', "%{$search->q}%");
        }
    
        if(!empty($search->minPrice)){
            $query = $query
                ->andWhere('c.price >= :minPrice * 100')
                ->setParameter('minPrice', $search->minPrice);
        }
    
        if(!empty($search->maxPrice)){
            $query = $query
                ->andWhere('c.price <= :maxPrice * 100')
                ->setParameter('maxPrice', $search->maxPrice);
        }

        if(!empty($search->minMiles)){
            $query = $query
                ->andWhere('c.miles >= :minMiles')
                ->setParameter('minMiles', $search->minMiles);
        }
    
        if(!empty($search->maxMiles)){
            $query = $query
                ->andWhere('c.miles <= :maxMiles')
                ->setParameter('maxMiles', $search->maxMiles);
        }

        if(!empty($search->minYear)){
            $query = $query
                ->andWhere('c.year >= :minYear')
                ->setParameter('minYear', $search->minYear);
        }
    
        if(!empty($search->maxYear)){
            $query = $query
                ->andWhere('c.year <= :maxYear')
                ->setParameter('maxYear', $search->maxYear);
        }
        
        $query = $query->getQuery();
        return $this->paginator->paginate(
            $query,
            $search->page,
            2
        );

    }

    

//    /**
//     * @return Car[] Returns an array of Car objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Car
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
