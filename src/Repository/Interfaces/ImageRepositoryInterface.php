<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 16/04/2018
 * Time: 01:35
 */

namespace App\Repository\Interfaces;

use Symfony\Bridge\Doctrine\RegistryInterface;

interface ImageRepositoryInterface
{
    public function __construct(RegistryInterface $registry);

}
