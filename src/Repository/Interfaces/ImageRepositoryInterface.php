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
    /**
     * ImageRepositoryInterface constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry);

    /**
     * @param $id
     * @return mixed
     */
    public function findImageById($id);

    /**
     * @param $image
     * @return mixed
     */
    public function removeImage($image);

    /**
     * @param $image
     * @return mixed
     */
    public function save($image);
}
