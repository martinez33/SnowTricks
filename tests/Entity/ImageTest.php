<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 24/03/2018
 * Time: 15:34
 */

namespace App\Tests\Entity;


use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function testGetPicture()
    {
        $picture = new Image();
        $result = $picture->getPicture();

        $this->assertSame(, $result);
    }
}