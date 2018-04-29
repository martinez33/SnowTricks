<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 27/04/2018
 * Time: 14:07
 */

namespace App\Helper\Interfaces;

use App\Repository\Interfaces\TrickRepositoryInterface;

interface UniqueTrickNameInterface
{
    public function __construct(TrickRepositoryInterface $trickRepository);

    public function isUniqueName($name);
}