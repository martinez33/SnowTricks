<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 22/04/2018
 * Time: 22:36
 */

namespace App\Domain\Interfaces;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface VideoInterface
 *
 * @package App\Domain\Interfaces
 */
interface VideoInterface
{
    /**
     * VideoInterface constructor.
     *
     * @param int $created
     * @param string $fileName
     * @param int|null $updated
     */
    public function __construct(
        string $fileName,
        int $updated = null
    );

    /**
     * @return int
     */
    public function getCreated(): int;

    /**
     * @return string
     */
    public function getFileName(): string;

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
     * @param TrickInterface
     */
    public function setTrick(TrickInterface $trick): void;
}