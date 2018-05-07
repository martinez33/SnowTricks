<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 29/03/2018
 * Time: 22:00.
 */

namespace App\Domain;

use App\Domain\Interfaces\ImageInterface;
use App\Domain\Interfaces\TrickInterface;
use Ramsey\Uuid\Uuid;

/**
 * Class Image
 *
 * @package App\Domain
 */
class Image implements ImageInterface
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $fileName;

    /**
     * @var int
     */
    private $created;

    /**
     * @var int
     */
    private $updated;

    /**
     * @var TrickInterface
     */
    private $trick;

    /**
     * @var string
     */
    private $ext;

    /**
     * Image constructor.
     *
     * @param int|null  $updated
     */
    public function __construct(
        string $fileName,
        string $ext,
        int $updated = null
    ) {
        $this->id = Uuid::uuid4();
        $this->created = time();
        $this->updated = time();
        $this->fileName = $fileName;
        $this->ext = $ext;
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
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @return int
     */
    public function getCreated(): int
    {
        return $this->created;
    }

    /**
     * @return int
     */
    public function getUpdated(): int
    {
        return $this->updated;
    }

    /**
     * @return string
     */
    public function getExt(): string
    {
        return $this->ext;
    }

    /**
     * @return TrickInterface
     */
    public function getTrick(): Trick
    {
        return $this->trick;
    }

    /**
     * @param int $updated
     */
    public function setUpdated(int $updated): void
    {
        $this->updated = $updated;
    }

    /**
     * @param Trick $trick
     *
     * @return Trick
     */
    public function setTrick(TrickInterface $trick)
    {
        $this->trick = $trick;
    }
}
