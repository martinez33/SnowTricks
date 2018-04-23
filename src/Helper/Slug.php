<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 11/04/2018
 * Time: 12:57
 */

namespace App\Helper;

use App\Helper\Interfaces\SlugInterface;

/**
 * Class Slug
 *
 * @package App\Helper
 */
class Slug implements SlugInterface
{
    /**
     * @param string $str
     * @return mixed|null|string|string[]
     */
    public function slug(string $str)
    {
        $slug = strtolower($str);
        $slug = preg_replace("/[^a-z0-9s-]/", "-", $slug);

        return $slug;
    }
}
