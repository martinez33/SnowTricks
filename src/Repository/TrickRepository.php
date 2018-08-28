<?php

namespace App\Repository;



use App\Domain\Trick;
use App\Repository\Interfaces\TrickRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

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
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getAllTricks()
    {
        return $this->createQueryBuilder('t')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $slug
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getTrickBySlug(string $slug)
    {
        return $this->createQueryBuilder('t')
            ->where('t.slug = :slug')
            ->setParameter('slug', $slug)
            ->join('t.image', 'image')
            ->getQuery()
            ->getOneOrNullResult();
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

    /**
     * @param $trick
     */
    public function delTrickBySlug($trick)
    {
        $this->_em->remove($trick);
        $this->_em->flush();
    }

    public function update()
    {
        $this->_em->flush();
    }

    public function test($id)
    {
      return $this->_em->find('App\Domain\Trick',$id);
    }

}
