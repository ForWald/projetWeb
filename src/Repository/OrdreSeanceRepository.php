<?php

namespace App\Repository;

use App\Entity\OrdreSeance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrdreSeance>
 *
 * @method OrdreSeance|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrdreSeance|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrdreSeance[]    findAll()
 * @method OrdreSeance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdreSeanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrdreSeance::class);
    }

//    /**
//     * @return OrdreSeance[] Returns an array of OrdreSeance objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OrdreSeance
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
