<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 22/04/2018
 * Time: 22:36
 */

namespace App\Domain\Interfaces;

use App\Domain\Interfaces\TrickInterface;


/**
 * Interface VideoInterface
 *
 * @package App\Domain\Interfaces
 */
interface VideoInterface
{
    /**
     * Video constructor.
     * @param string $vidId
     * @param string $vidType
     * @param int|null $updated
     * @throws \Exception
     */
    public function __construct(
        string $vidId,
        string $vidType,
        int $updated = null
    );

    /**
     * @return int
     */
    public function getCreated(): int;

    /**
     * @return string
     */
    public function getVidType(): string;

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
