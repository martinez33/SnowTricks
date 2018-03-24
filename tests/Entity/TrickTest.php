<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 19/03/2018
 * Time: 16:55
 */

namespace App\Tests\Entity;

use App\Entity\Trick;
use App\Tests\Entity\Interfaces\TrickInterfaceTest;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;



class TrickTest extends TestCase implements TrickInterfaceTest
{

    /**
     * @return string|void
     */
    public function testGetTrickName()
    {
        $trick = new Trick('360°', 'Rotation d\'un tour', 1);
        $result = $trick->getTrickName();

        $this->assertSame('360°', $result);
    }

    /**
     * @return string|void
     */
    public function testGetTrickDescription()
    {
        $trick = new Trick('360°', 'Rotation d\'un tour', 1);
        $result = $trick->getTrickDescription();

        $this->assertSame('Rotation d\'un tour', $result);
    }

    /**
     * @return int|void
     */
    public function testGetTrickGrp()
    {
        $trick = new Trick('360°', 'Rotation d\'un tour', 1 );
        $result = $trick->getTrickGrp();

        $this->assertSame(1, $result);
    }

}