<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 06/04/2018
 * Time: 22:38
 */

namespace App\Tests\Domain;


use App\Domain\Trick;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use TrickInterfaceTest;

class TrickTest extends TestCase implements  TrickInterfaceTest
{
    public function testGetId()
    {
        $trick = new Trick();
        $result = $trick->getId();

        $this->assertSame(Uuid::uuid4(), $result);

    }

    public function testGetName()
    {
        $trick = new Trick();
        $trick->setName('name');
        $result = $trick->getName();

        $this->assertSame('name', $result);
    }

    public function testGetDescription()
    {
        $trick = new Trick();
        $trick->setDescription('description');
        $result = $trick->getDescription();

        $this->assertSame('description', $result);
    }


}