<?php

namespace App\Repository;

use App\Entity\JobToCandidat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JobToCandidat>
 *
 * @method JobToCandidat|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobToCandidat|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobToCandidat[]    findAll()
 * @method JobToCandidat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobToCandidatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobToCandidat::class);
    }

    //    /**
    //     * @return JobToCandidat[] Returns an array of JobToCandidat objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('j')
    //            ->andWhere('j.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('j.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?JobToCandidat
    //    {
    //        return $this->createQueryBuilder('j')
    //            ->andWhere('j.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
