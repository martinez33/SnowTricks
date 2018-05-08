<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 12/04/2018
 * Time: 15:45
 */

namespace App\Helper;

use App\Helper\Interfaces\FileUpLoaderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileUpLoader
 *
 * @package App\Helper
 */
class FileUpLoader implements FileUpLoaderInterface
{
    /**
     * @var string
     */
    private $targetImgDirectory;

    /**
     * FileUpLoader constructor.
     *
     * @param $targetDirectory
     */
    public function __construct(string $targetImgDirectory)
    {
        $this->targetImgDirectory = $targetImgDirectory;
    }


    /**
     * @param UploadedFile $file
     * @return mixed|null|string
     */
    public function upLoadImg(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->getClientOriginalExtension();

        $file->move($this->getTargetImgDirectory(), $fileName);

        return $fileName;
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function upLoadVideo(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->getClientOriginalExtension();

        $file->move($this->getTargetVideoDirectory(), $fileName);

        return $fileName;
    }

    /**
     * @return string
     */
    public function getTargetImgDirectory()
    {
        return $this->targetImgDirectory;
    }
}
