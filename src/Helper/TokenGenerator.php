<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 20/07/2018
 * Time: 15:10
 */

namespace App\Helper;


class TokenGenerator
{
    public function tokenMaker($length)
    {
        return md5(substr(str_shuffle((string) uniqid()), 0, $length));
    }
}