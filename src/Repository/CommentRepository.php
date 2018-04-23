<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/04/2018
 * Time: 02:34
 */

namespace App\Repository;

use App\Domain\Comment;
use App\Repository\Interfaces\CommentRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class CommentRepository
 *
 * @package App\Repository
 */
class CommentRepository extends ServiceEntityRepository implements CommentRepositoryInterface
{
    /**
     * CommentRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function findAllComment()
    {
        return $this->createQueryBuilder('c')
            ->select('c.content')
            ->getQuery()
            ->getResult()
            ;
    }
}
