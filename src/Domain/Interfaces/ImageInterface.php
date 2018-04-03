<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 29/03/2018
 * Time: 22:00
 */

namespace App\Domain\Interfaces;

use App\Domain\Trick;

interface ImageInterface
{
    public function __construct(int $updated = null);

    public function getId();

    public function getFileName();

    public function getExt();

    public function getCreated();

    public function getUpdated();

    public function getTrick();

    public function setFileName(string $fileName);

    public function setExt(string $ext);

    public function setUpdated(int $updated);

    public function setTrick(Trick $trick);
}