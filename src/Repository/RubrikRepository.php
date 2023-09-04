<?php

namespace App\Repository;

use App\Entity\Rubrik;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rubrik>
 *
 * @method Rubrik|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rubrik|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rubrik[]    findAll()
 * @method Rubrik[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RubrikRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rubrik::class);
    }

//    /**
//     * @return Rubrik[] Returns an array of Rubrik objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Rubrik
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
