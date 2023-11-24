<?php

namespace App\Repository;

use App\Entity\OrdreExercice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrdreExercice>
 *
 * @method OrdreExercice|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrdreExercice|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrdreExercice[]    findAll()
 * @method OrdreExercice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdreExerciceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrdreExercice::class);
    }

//    /**
//     * @return OrdreExercice[] Returns an array of OrdreExercice objects
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

//    public function findOneBySomeField($value): ?OrdreExercice
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
