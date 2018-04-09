<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/04/2018
 * Time: 02:40
 */

namespace App\Repository\Interfaces;

use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bridge\Doctrine\RegistryInterface;

interface CommentRepositoryInterface
{
    public function __construct(RegistryInterface $registry);

    public function findAllComment();
}