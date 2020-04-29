<?php

namespace App\Repository;

use App\Entity\Channel;
use App\Entity\User;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAudienceTokensByChannel(Channel $channel): ?array
    {
        return $this->createQueryBuilder('u')
            ->select('u.token')
            ->andWhere('u.channel = :channel')
            ->setParameter('channel', $channel)
            ->andWhere('u.isConnected = :boolean')
            ->setParameter('boolean', true)
            ->andWhere('u.isStoryteller = :boolean2')
            ->setParameter('boolean2', false)
            ->getQuery()
            ->getScalarResult()
        ;
    }

    public function findAudienceByChannel(Channel $channel): ?array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.channel = :channel')
            ->setParameter('channel', $channel)
            ->andWhere('u.isConnected = :boolean')
            ->setParameter('boolean', true)
            ->andWhere('u.isStoryteller = :boolean2')
            ->setParameter('boolean2', false)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findStorytellerByChannel(Channel $channel): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.channel = :channel')
            ->setParameter('channel', $channel)
            ->andWhere('u.isStoryteller = :boolean')
            ->setParameter('boolean', true)
            ->andWhere('u.isConnected = :boolean2')
            ->setParameter('boolean2', true)
            ->getQuery()
            ->getSingleResult()
        ;    
    }
}
