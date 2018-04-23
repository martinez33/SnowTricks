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
    /**
     * TrickRepository constructor.
     *
     * @param RegistryInterface $registry
     */
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
            ->select('t.name', 't.slug', 'image.fileName')
            ->join('t.image', 'image')
            ->groupBy('t.name')
            ->getQuery()
            ->getResult();

    }

    /**
     * @param $slug
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findTrick($slug)
    {
        return $this->createQueryBuilder('t')
            ->select(
                't.name',
                't.description',
                't.grp',
                't.slug',
                'image.fileName'
            )
            ->join('t.image', 'image')
            ->where('t.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->setMaxResults(1)
            ->getResult();
    }

    public function findImgByTrick($slug)
    {
        return $this->createQueryBuilder('t')
            ->select('t.slug', 'image.fileName')
            ->join('t.image', 'image')
            ->where('t.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getResult();
    }

    public function findVideoByTrick($slug)
    {
        return $this->createQueryBuilder('t')
            ->select('t.slug', 'video.fileName')
            ->join('t.video', 'video')
            ->where('t.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param  $data
     *
     * @throws \Doctrine\ORM\ORMException
     */
    public function save($data)
    {
        $this->getEntityManager()->persist($data);
        $this->getEntityManager()->flush();
    }

    public function findNameExist($dataName)
    {
        return $this->createQueryBuilder('t')
            ->select('t.name')
            ->where('t.name = :dataName')
            ->setParameter('dataName', $dataName)
            ->getQuery()
            ->getResult();
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
