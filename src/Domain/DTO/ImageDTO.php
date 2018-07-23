<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 11/07/2018
 * Time: 22:43
 */

namespace App\Domain\DTO;


use phpDocumentor\Reflection\File;

class ImageDTO
{
    /**
     * @var File
     */
    public $file;

    /**
     * @var bool
     */
    public $first;

    /**
     * @var string
     */
    public $storageId;

    /**
     * @var string
     */
    public $ext;

    /**
     * @var string
     */
    public $filename;

    /**
     * ImageDTO constructor.
     * @param File $file
     * @param bool $first
     * @param string $storageId
     * @param string $ext
     * @param string $filename
     */
    public function __construct(
        File $file = null,
        bool $first = false,
        string $storageId = null,
        string $ext = null,
        string $filename = null
    ) {
        $this->file = $file;
        $this->first = $first;
        $this->storageId = $storageId;
        $this->ext = $ext;
        $this->filename = $filename;
    }


    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param $file $file
     */
    public function setFile($file): void
    {
        $this->file = $file;
    }

    /**
     * @return bool
     */
    public function isFirst(): bool
    {
        return $this->first;
    }

    /**
     * @param bool $first
     */
    public function setFirst(bool $first): void
    {
        $this->first = $first;
    }



    /**
     * @return mixed
     */
    public function getStorageId()
    {
        return $this->storageId;
    }

    /**
     * @param mixed $storageId
     */
    public function setStorageId($storageId): void
    {
        $this->storageId = $storageId;
    }

    /**
     * @return mixed
     */
    public function getExt()
    {
        return $this->ext;
    }

    /**
     * @param mixed $ext
     */
    public function setExt($ext): void
    {
        $this->ext = $ext;
    }

    /**
     * @return mixed
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param mixed $filename
     */
    public function setFilename($filename): void
    {
        $this->filename = $filename;
    }


}