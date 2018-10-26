<?php

namespace App\Repository;

use App\Entity\ItemsPerGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ItemsPerGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemsPerGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemsPerGroup[]    findAll()
 * @method ItemsPerGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemsPerGroupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ItemsPerGroup::class);
    }

//    /**
//     * @return ItemsPerGroup[] Returns an array of ItemsPerGroup objects
//     */
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
    public function findOneBySomeField($value): ?ItemsPerGroup
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
