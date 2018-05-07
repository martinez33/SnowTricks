<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 25/04/2018
 * Time: 14:13
 */

namespace App\Helper;

use App\Helper\Interfaces\FindUrlInterface;

class FindUrl implements FindUrlInterface
{
    public function SearchUrl(string $str)
    {
        $regex = '#(https|http):\/\/(www.youtube.com|www.dailymotion.com|www.vimeo.com)(\/\w+){1,}#';

        preg_match($regex, $str, $matches);

        $url = $matches[0];

        return $url;
    }
}
