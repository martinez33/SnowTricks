<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 07/04/2018
 * Time: 16:25
 */

namespace App\Tests\Domain;


use App\Domain\Comment;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;

class CommentTest extends TestCase
{
    /**
     * @test
     */
    public function testGetId()
    {
        $com = new Comment();
        $result = $com->getId();

        $this->assertInstanceOf(UuidInterface::class, $result);
    }

    /**
     * @test
     */
    public function testGetContent()
    {
        $com = new Comment();
        $com->setContent('Voilà un trick pour lequel il faut être experimenté !');
        $result = $com->getContent();

        $this->assertSame('Voilà un trick pour lequel il faut être experimenté !', $result);
    }

    /**
     * @test
     */
    public function testGetCreated()
    {
        $com = new Comment();
        $result = $com->getCreated();

        $this->assertSame(time(), $result);
    }

}