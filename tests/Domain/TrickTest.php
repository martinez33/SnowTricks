<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 06/04/2018
 * Time: 22:38
 */

namespace App\Tests\Domain;


use App\Domain\Trick;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;


class TrickTest extends TestCase
{
    /**
     * @var ArrayCollection
     */
    private $comment;

    /**
     * @var ArrayCollection
     */
    private $image;

    /**
     * @var ArrayCollection
     */
    private $video;

    protected function setUp()
    {
        $this->comment = $this->createMock(ArrayCollection::class);
        $this->image = $this->createMock(ArrayCollection::class);
        $this->video = $this->createMock(ArrayCollection::class);
    }

    public function testConstruct()
    {
        $trick = new Trick('Grab de la planche', 'Grab', 'Japan Air', 'japan-air');

        $trick->setComment($this->comment);
        $trick->setImage($this->image);
        $trick->setVideo($this->video);

        $this->assertInstanceOf(UuidInterface::class, $trick->getId());
        $this->assertSame('Grab de la planche', $trick->getDescription());
        $this->assertSame('Grab', $trick->getGrp());
        $this->assertSame('Japan Air', $trick->getName());
        $this->assertSame('japan-air', $trick->getSlug());
        $this->assertSame(time(), $trick->getCreated());
        $this->assertSame(time(), $trick->getUpdated());

        $this->assertInstanceOf(ArrayCollection::class, $trick->getComment());
        $this->assertInstanceOf(ArrayCollection::class, $trick->getImage());
        $this->assertInstanceOf(ArrayCollection::class, $trick->getVideo());
    }

}