<?php

namespace App\Repository;

use App\Entity\Jewel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Jewel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jewel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jewel[]    findAll()
 * @method Jewel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JewelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Jewel::class);
    }
}
