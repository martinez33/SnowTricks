<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 22/04/2018
 * Time: 23:43
 */

namespace App\Domain\Builder\Interfaces;

use App\Domain\Interfaces\TrickInterface;
use App\Domain\Interfaces\VideoInterface;

interface VideoBuilderInterface
{
    public function create(string $fileName, TrickInterface $trick);

    public function getVideo(): VideoInterface;
}