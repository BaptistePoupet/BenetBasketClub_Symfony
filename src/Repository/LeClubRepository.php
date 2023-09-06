<?php

namespace App\Repository;

use App\Entity\LeClub;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LeClub>
 *
 * @method LeClub|null find($id, $lockMode = null, $lockVersion = null)
 * @method LeClub|null findOneBy(array $criteria, array $orderBy = null)
 * @method LeClub[]    findAll()
 * @method LeClub[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LeClubRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LeClub::class);
    }

//    /**
//     * @return LeClub[] Returns an array of LeClub objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LeClub
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
