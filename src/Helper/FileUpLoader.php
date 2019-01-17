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
     * @var string
     */
    private $targetPictDirectory;

    /**
     * FileUpLoader constructor.
     * @param string $targetImgDirectory
     * @param string $targetPictDirectory
     */
    public function __construct(string $targetImgDirectory, string $targetPictDirectory)
    {
        $this->targetImgDirectory = $targetImgDirectory;
        $this->targetPictDirectory = $targetPictDirectory;
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
    public function upLoadPict(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->getClientOriginalExtension();

        $file->move($this->getTargetPictDirectory(), $fileName);

        return $fileName;
    }

    /**
     * @return string
     */
    public function getTargetImgDirectory()
    {
        return $this->targetImgDirectory;
    }

    /**
     * @return string
     */
    public function getTargetPictDirectory()
    {
        return $this->targetPictDirectory;
    }
}
