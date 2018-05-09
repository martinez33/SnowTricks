<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 15/04/2018
 * Time: 00:01
 */

namespace App\Domain\Builder\Interfaces;

use App\Domain\Interfaces\TrickInterface;

interface ImageBuilderInterface
{
    public function create(string $ext, string $fileName, bool $first, TrickInterface $trick);

    public function getImage();
}
