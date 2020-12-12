<?php

namespace App\Infrastructure\Doctrine\Repository\Hub;

use App\Infrastructure\Doctrine\Entity\Hub\HubUserRole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HubUserRole|null find($id, $lockMode = null, $lockVersion = null)
 * @method HubUserRole|null findOneBy(array $criteria, array $orderBy = null)
 * @method HubUserRole[]    findAll()
 * @method HubUserRole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HubUserRoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HubUserRole::class);
    }
}
