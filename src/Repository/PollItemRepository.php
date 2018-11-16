<?php

namespace App\Repository;

use App\Entity\PollItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PollItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method PollItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method PollItem[]    findAll()
 * @method PollItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PollItemRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PollItem::class);
    }

//    /**
//     * @return PollItem[] Returns an array of PollItem objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PollItem
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
