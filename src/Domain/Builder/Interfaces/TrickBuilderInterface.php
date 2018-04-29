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
    public function create(
        string $name,
        string $description,
        string $grp,
        string $slug
    );

    public function getTrick(): TrickInterface;
}
