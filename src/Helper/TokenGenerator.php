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
        $str = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";

        $token = substr(str_shuffle(str_repeat($str, $length)), 0, $length);

        return $token;
    }
}