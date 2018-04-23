<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 11/04/2018
 * Time: 13:08
 */

namespace App\Helper\Interfaces;

/**
 * Interface SlugInterface
 *
 * @package App\Helper\Interfaces
 */
interface SlugInterface
{
    /**
     * @param string $str
     * @return mixed
     */
    public function slug(string $str);
}
