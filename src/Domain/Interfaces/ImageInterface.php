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
     * @return string
     */
    public function getExt();

    /**
     * @return int
     */
    public function getCreated();

    /**
     * @return int
     */
    public function getUpdated();

    /**
     * @return Trick
     */
    public function getTrick();

    /**
     * @param string $fileName
     *
     * @return string
     */
    public function setFileName(string $fileName);

    /**
     * @param string $ext
     *
     * @return string
     */
    public function setExt(string $ext);

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
    public function setTrick(Trick $trick);
}
