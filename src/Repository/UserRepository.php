<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 10/07/2018
 * Time: 00:37
 */

namespace App\Repository;


use App\Domain\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    /**
     * UserRepository constructor.
     *
     * @param ManagerRegistry $registry
     * @param string $entityClass
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class );
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
}