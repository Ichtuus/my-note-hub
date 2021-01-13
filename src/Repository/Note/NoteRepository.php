<?php

namespace App\Repository\Note;

use App\Entity\Note\Note;
use App\Entity\Hub\Hub;
use App\Repository\Hub\HubRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Note|null find($id, $lockMode = null, $lockVersion = null)
 * @method Note|null findOneBy(array $criteria, array $orderBy = null)
 * @method Note[]    findAll()
 * @method Note[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteRepository extends ServiceEntityRepository implements HubRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Note::class);
    }


    public function findByHub(Hub $hub, $limit = self::LIMIT, $hydrationMode = AbstractQuery::HYDRATE_OBJECT)
    {
        return $this->createQueryBuilder('note')
            ->where('note.hub = :hub_id')
            ->setParameter('hub_id', $hub->getId())
            ->setMaxResults($limit)
            ->orderBy('note.creationDatetime', 'DESC')
            ->getQuery()
            ->getResult($hydrationMode);
    }
}
