<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 14/04/2018
 * Time: 23:22
 */

namespace App\Domain\Builder\Interfaces;

use App\Domain\Interfaces\TrickInterface;

interface TrickBuilderInterface
{
    public function createTrick(
        string $description,
        string $grp,
        string $name,
        string $slug,
        array $images
    );

    public function getTrick(): TrickInterface;
}
