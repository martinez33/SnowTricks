<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 07/04/2018
 * Time: 20:50
 */

namespace App\Domain;


use App\Domain\Interfaces\CommentInterface;
use Ramsey\Uuid\Uuid;

/**
 * Class Comment
 *
 * @package App\Domain
 */
class Comment implements CommentInterface
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $content;

    /**
     * @var int
     */
    private $created;
    /**
     * @var Trick
     */
    private $trick;

    /**
     * Comment constructor.
     * @param \Ramsey\Uuid\UuidInterface $id
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->created = time();
    }

    /**
     * @return \Ramsey\Uuid\UuidInterface
     */
    public function getId(): \Ramsey\Uuid\UuidInterface
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function getCreated(): int
    {
        return $this->created;
    }

    /**
     * @return Trick
     */
    public function getTrick(): Trick
    {
        return $this->trick;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @param Trick $trick
     */
    public function setTrick(Trick $trick): void
    {
        $this->trick = $trick;
    }

}