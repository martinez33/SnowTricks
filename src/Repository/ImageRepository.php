<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 16/04/2018
 * Time: 01:36
 */

namespace App\Repository;

use App\Domain\Image;
use App\Domain\Trick;
use App\Repository\Interfaces\ImageRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ImageRepository extends ServiceEntityRepository implements ImageRepositoryInterface
{
    /**
     * ImageRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Image::class);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findImageById($id)
    {
        return $this->createQueryBuilder('i')
            ->where('i.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param $image
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function removeImage($image)
    {
        $this->_em->remove($image);
        $this->_em->flush();
    }

    /**
     * @param $image
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save($image)
    {
        $this->_em->persist($image);
        $this->_em->flush();
    }
}
