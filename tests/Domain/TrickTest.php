<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 06/04/2018
 * Time: 22:38
 */

namespace App\Tests\Domain;

use App\Domain\Trick;
use App\Tests\Domain\Interfaces\TrickTestInterface;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;


class TrickTest extends TestCase implements TrickTestInterface
{
    /**
     * @test
     */
    public function testGetId()
    {
        $trick = new Trick();
        $result = $trick->getId();

        $this->assertInstanceOf(UuidInterface::class, $result);
    }

    /**
     * @test
     */
    public function testGetName()
    {
        $trick = new Trick();
        $trick->setName('name');
        $result = $trick->getName();

        $this->assertSame('name', $result);
    }

    /**
     * @test
     */
    public function testGetDescription()
    {
        $trick = new Trick();
        $trick->setDescription('description');
        $result = $trick->getDescription();

        $this->assertSame('description', $result);
    }

    /**
     * @test
     */
    public function testGetCreated()
    {
        $trick = new Trick();
        $result = $trick->getCreated();

        $this->assertSame(time(), $result);
    }

    /**
     * @test
     */
    public function testGetUpdated()
    {
        $trick = new Trick();
        $result = $trick->getUpdated();

        $this->assertSame(time(), $result);
    }

    /**
     * @test
     */
    public function testGetImage()
    {
        $trick = new Trick();
        $result = $trick->getImage();

        $this->assertInstanceOf(ArrayCollection::class, $result);
    }

    public function testGetComment()
    {
        $trick = new Trick();
        $result = $trick->getComment();

        $this->assertInstanceOf(ArrayCollection::class, $result);
    }

}