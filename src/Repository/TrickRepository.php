<?php

namespace App\Repository;

use App\Domain\Trick;
use App\Repository\Interfaces\TrickRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Trick|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trick|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trick[]    findAll()
 * @method Trick[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrickRepository extends ServiceEntityRepository implements TrickRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Trick::class);
    }

    /**
     * @return array
     */
    public function findAllTrick()
    {
        return $this->createQueryBuilder('t')
            ->select('t.name')
            ->join('t.image', 'image')
            ->addSelect('image.fileName', 'image.ext')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param $name
     * @return array
     */
    public function findTrick($name)
    {
        return $this->createQueryBuilder('t')
            ->select('t.name', 't.description', 't.grp' )
            ->join('t.image', 'image')
            ->join('t.comment', 'comment')
            ->addSelect('image.fileName', 'image.ext', 'comment.content')
            ->where('t.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Trick
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
