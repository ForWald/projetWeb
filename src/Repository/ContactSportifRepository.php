<?php

namespace App\Repository;

use App\Entity\ContactSportif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ContactSportif>
 *
 * @method ContactSportif|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactSportif|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactSportif[]    findAll()
 * @method ContactSportif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactSportifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactSportif::class);
    }

//    /**
//     * @return ContactSportif[] Returns an array of ContactSportif objects
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

//    public function findOneBySomeField($value): ?ContactSportif
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
