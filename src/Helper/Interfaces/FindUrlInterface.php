<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 25/04/2018
 * Time: 14:08
 */

namespace App\Helper\Interfaces;

interface FindUrlInterface
{
    public function SearchVideoType(string $str);

    public function FindVideoId(string $str, string $type);
}
