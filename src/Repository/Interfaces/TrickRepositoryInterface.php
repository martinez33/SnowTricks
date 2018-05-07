<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 03/04/2018
 * Time: 21:43.
 */

namespace App\Repository\Interfaces;

use Symfony\Bridge\Doctrine\RegistryInterface;

interface TrickRepositoryInterface
{
    public function __construct(RegistryInterface $registry);

    public function findAllTrick();

    public function findImgByTrick($slug);

    public function findVideoByTrick($slug);

    public function findTrick($name);

    public function save($data);

    public function findNameExist($dataName);

    public function delTrickBySlug($slug);

    public function modifyTrick($slug, $tName, $tDescription, $grp, $newSlug, $updated);

    //public function modifyImage($slug, $fileName, $updated);
}
