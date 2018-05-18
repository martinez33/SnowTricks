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

    public function getAllTricks();

    public function getTrickBySlug(string $slug);

    public function save($data);

    public function delTrickBySlug($slug);

    public function test($slug);

    public function update();

    //public function modifyTrick($slug, $tName, $tDescription, $grp, $newSlug, $updated);

}
