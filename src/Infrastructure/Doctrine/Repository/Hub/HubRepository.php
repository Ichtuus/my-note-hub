<?php

namespace App\Infrastructure\Doctrine\Repository\Hub;

use App\Infrastructure\Doctrine\Entity\Hub\Hub;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Hub|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hub|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hub[]    findAll()
 * @method Hub[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HubRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hub::class);
    }
}
