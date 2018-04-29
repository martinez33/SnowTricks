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
    /**
     * ImageInterface constructor.
     *
     * @param int|null $updated
     * @param string   $ext
     */
    public function __construct(
        string $fileName,
        string $ext,
        int $updated = null
    );

    /**
     * @return \Ramsey\Uuid\UuidInterface
     */
    public function getId();

    /**
     * @return string
     */
    public function getFileName();

    /**
     * @return int
     */
    public function getCreated();

    /**
     * @return int
     */
    public function getUpdated();

    /**
     * @return TrickInterface
     */
    public function getTrick();

    /**
     * @return string
     */
    public function getExt();

    /**
     * @param int $updated
     *
     * @return int
     */
    public function setUpdated(int $updated);

    /**
     * @param Trick $trick
     *
     * @return Trick
     */
    public function setTrick(TrickInterface $trick);
}
