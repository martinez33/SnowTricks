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
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Image
 *
 * @package App\Domain
 */
class Image implements ImageInterface
{
    /**
     * @var int
     */
    private $created;

    /**
     * @var string
     *
     * @Assert\NotEqualTo("php")
     */
    private $ext;

    /**
     * @var string
     */
    private $fileName;

    /**
     * @var bool
     */
    private $first;

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
     * Image constructor.
     *
     * @param int $created
     * @param string $ext
     * @param string $fileName
     * @param bool $first
     * @param \Ramsey\Uuid\UuidInterface $id
     * @param TrickInterface $trick
     * @param int $updated
     */
    public function __construct(
        string $ext,
        string $fileName,
        bool $first = false,
        int $updated = null
    ) {
        $this->created = time();
        $this->ext = $ext;
        $this->fileName = $fileName;
        $this->first = $first;
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
    public function getExt(): string
    {
        return $this->ext;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @return bool
     */
    public function isFirst(): bool
    {
        return $this->first;
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
     * @param bool $first
     */
    public function setFirst(bool $first): void
    {
        $this->first = $first;
    }

    /**
     * @param int $updated
     */
    public function setUpdated(int $updated): void
    {
        $this->updated = $updated;
    }

    /**
     * @param TrickInterface $trick
     */
    public function setTrick(TrickInterface $trick)
    {
        $this->trick = $trick;
    }
}
