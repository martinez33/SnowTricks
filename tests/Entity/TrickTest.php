<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 19/03/2018
 * Time: 16:55
 */

namespace App\Tests\Entity;

use App\Entity\Interfaces\TrickInterface;
use App\Entity\Trick;
use App\Tests\Entity\Interfaces\TrickInterfaceTest;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;



class TrickTest extends TestCase
{
    /**
     * @return $string|void
     */
    public function testInstanceInterfaceOf()
    {
        $trick = new Trick('360°', 'Rotation d\un tour', 'Rotation');

        static::assertInstanceOf(TrickInterface::class, $trick);
    }

    /**
     * @return string|void
     */
    public function testGetName()
    {
        $trick = new Trick('360°', 'Rotation d\'un tour', 'Rotation');

        $this->assertSame('360°', $trick->getName());
    }

    /**
     * @return string|void
     */
    public function testGetDescription()
    {
        $trick = new Trick('360°', 'Rotation d\'un tour', 'Rotation');
        $result = $trick->getDescription();

        $this->assertSame('Rotation d\'un tour', $result);
    }

    /**
     * @return int|void
     */
    public function testGetGroup()
    {
        $trick = new Trick('360°', 'Rotation d\'un tour', 'Rotation' );
        $result = $trick->getGroup();

        $this->assertSame('Rotation', $result);
    }

    public function testGetCreated()
    {
        $trick = new Trick('360°', 'Rotation d\'un tour', 'Rotation' );

        static::assertEquals(time(), $trick->getCreated());
    }

}