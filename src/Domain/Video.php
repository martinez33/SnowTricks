<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 22/04/2018
 * Time: 22:38
 */

namespace App\Domain;

use App\Domain\Interfaces\TrickInterface;
use App\Domain\Interfaces\VideoInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;

class Video implements VideoInterface
{
    /**
     * @var int
     */
    private $created;

    /**
     * @var string
     */
    private $fileName;

    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    private $id;

    /**
     * @var TrickInterface
     */
    private $trick;

    /**
     * @var int
     */
    private $updated;

    /**
     * Video constructor.
     *
     * @param int              $created
     * @param string           $fileName
     * @param int|null         $updated
     */
    public function __construct(
        string $fileName,
        int $updated = null
    ) {
        $this->created = time();
        $this->fileName = $fileName;
        $this->id = Uuid::uuid4();
        $this->updated = time();
    }

    /**
     * @return int
     */
    public function getCreated(): int
    {
        return $this->created;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @return \Ramsey\Uuid\UuidInterface
     */
    public function getId(): \Ramsey\Uuid\UuidInterface
    {
        return $this->id;
    }

    /**
     * @return TrickInterface
     */
    public function getTrick(): TrickInterface
    {
        return $this->trick;
    }

    /**
     * @return int
     */
    public function getUpdated(): int
    {
        return $this->updated;
    }

    /**
     * @param TrickInterface $trick
     */
    public function setTrick(TrickInterface $trick): void
    {
        $this->trick = $trick;
    }
}
