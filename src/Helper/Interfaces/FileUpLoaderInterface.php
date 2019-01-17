<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 13/04/2018
 * Time: 03:20
 */

namespace App\Helper\Interfaces;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Interface FileUpLoaderInterface
 *
 * @package App\Helper\Interfaces
 */
interface FileUpLoaderInterface
{
    /**
     * FileUpLoader constructor.
     * @param string $targetImgDirectory
     * @param string $targetPictDirectory
     */
    public function __construct(string $targetImgDirectory, string $targetPictDirectory);

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function upLoadImg(UploadedFile $file);

    /**
     * @param UploadedFile $file
     * @return string
     /*
    public function upLoadVideo(UploadedFile $file);*/

    /**
     * @return string
     */
    public function getTargetImgDirectory();
}
