<?php

namespace App\Repository;

use App\Entity\Tester;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tester|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tester|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tester[]    findAll()
 * @method Tester[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TesterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tester::class);
    }

    public function fetchRowByID(int $id): ?array {
        return $this->createQueryBuilder("tst")
            ->andWhere("tst.id = :myID")
            ->setParameter("myID", $id)
            ->orderBy("tst.id", "DESC")
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }

    public function customQuery(int $id): ?array {
        $entityManager = $this->getEntityManager();

        return $entityManager->createQuery(
            "SELECT tst FROM App\Entity\Tester tst 
            WHERE tst.id = :myID 
            ORDER BY tst.id DESC"
        )
            ->setParameter("myID", $id)
            ->execute();
    }

    // /**
    //  * @return Tester[] Returns an array of Tester objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tester
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
