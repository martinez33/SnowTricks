<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 22/10/2018
 * Time: 14:55
 */

namespace App\Repository\Interfaces;


use Symfony\Bridge\Doctrine\RegistryInterface;

interface VideoRepositoryInterface
{
    /**
     * VideoRepositoryInterface constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry);

    /**
     * @param $video
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function removeVideo($video);

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update();

}