<?php

namespace App\Repository;

use App\Entity\Stone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stone|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stone|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stone[]    findAll()
 * @method Stone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StoneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stone::class);
    }
}
