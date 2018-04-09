<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 07/04/2018
 * Time: 19:13
 */

namespace App\Tests\Domain;


use App\Domain\Image;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;

class ImageTest extends TestCase
{
    /**
     * @test
     */
    public function testGetId()
    {
        $image = new Image();
        $result = $image->getId();

        $this->assertInstanceOf(UuidInterface::class, $result);
    }

    /**
     * @test
     */
    public function testGetFileName()
    {
        $image = new Image();
        $image->setFileName('SM-mute');
        $result = $image->getFileName();

        $this->assertSame('SM-mute', $result);
    }

    /**
     * @test
     */
    public function testGetExt()
    {
        $image = new Image();
        $image->setExt('.jpg');
        $result = $image->getExt();

        $this->assertSame('.jpg', $result);
    }

    /**
     * @test
     */
    public function testGetCreated()
    {
        $image = new Image();
        $result = $image->getCreated();

        $this->assertSame(time(), $result);
    }

    /**
     * @test
     */
    public function testGetUpdated()
    {
        $image = new Image();
        $result = $image->getUpdated();

        $this->assertSame(time(), $result);
    }

}