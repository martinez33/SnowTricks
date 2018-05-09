<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 29/03/2018
 * Time: 22:00.
 */

namespace App\Domain\Interfaces;

use App\Domain\Trick;

interface ImageInterface
{
    public function __construct(
        string $ext,
        string $fileName,
        bool $first = false,
        int $updated = null
    );

    /**
     * @return int
     */
    public function getCreated(): int;

    /**
     * @return string
     */
    public function getExt(): string;

    /**
     * @return string
     */
    public function getFileName(): string;

    /**
     * @return bool
     */
    public function isFirst(): bool;

    /**
     * @return \Ramsey\Uuid\UuidInterface
     */
    public function getId(): \Ramsey\Uuid\UuidInterface;

    /**
     * @return TrickInterface
     */
    public function getTrick(): TrickInterface;

    /**
     * @return int
     */
    public function getUpdated(): int;

    /**
     * @param bool $first
     */
    public function setFirst(bool $first): void;

    /**
     * @param int $updated
     */
    public function setUpdated(int $updated): void;

    /**
     * @param TrickInterface $trick
     */
    public function setTrick(TrickInterface $trick);
}
