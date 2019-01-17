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
    public function SearchVideoType(string $str)
    {

        if (strpos($str, 'youtube') !== false) {

            $type = 'Youtube';

        } elseif (strpos($str, 'dailymotion') !== false) {

            $type = 'Dailymotion';

        } elseif (strpos($str, 'vimeo') !== false) {

            $type = 'Vimeo';
        }
       return $type;
    }

    public function FindVideoId(string $str, string $type)
    {
        if ($type === 'Youtube') {

            $reg = "#.+?https?:\/\/www.youtube.com\/embed\/([a-z0-9A-Z_-]+).+?#i";

            preg_match($reg, $str, $matches);

            $vidId = $matches[1];

        } elseif ($type === 'Dailymotion') {

            $reg = "#.//www.dailymotion.com/embed/video/([a-z0-9_-]+).+?#i";

            preg_match($reg, $str, $matches);

            $vidId = $matches[1];

        } elseif ($type === "Vimeo") {

            $reg = "#.+?https?://player.vimeo.com/video/([a-z0-9_-]+).+?#i";

            preg_match($reg, $str, $matches);

            $vidId = $matches[1];
        }

        return $vidId;
    }
}
