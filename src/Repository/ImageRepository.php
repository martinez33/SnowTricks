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
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Image::class);
    }


    public function modifyImage($slug, $fileName, $updated)
    {
        return $this->createQueryBuilder('i')
            ->update()
            ->leftJoin('i.trick_id', 'trick_id')
            ->where('trick.id = i.trickId')
            ->set('i.fileName', '?2')
            ->set('i.updated', '?3')
            ->setParameter(1, $slug)
            ->setParameter(2, $fileName)
            ->setParameter(3, $updated)
            ->getQuery()
            ->getResult();
    }
}
