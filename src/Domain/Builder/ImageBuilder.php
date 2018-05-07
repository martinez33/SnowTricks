<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 14/04/2018
 * Time: 23:52
 */

namespace App\Domain\Builder;

use App\Domain\Builder\Interfaces\ImageBuilderInterface;
use App\Domain\Image;
use App\Domain\Interfaces\ImageInterface;
use App\Domain\Interfaces\TrickInterface;

class ImageBuilder implements ImageBuilderInterface
{
    /**
     * @var ImageInterface
     */
    private $image;

    /**
     *
     * @var string
     */
    private $fileName;

    /**-
     * @var string
     */
    private $ext;

    /**
     * @var TrickInterface
     */
    private $trick;


    public function create(string $fileName, string $ext, TrickInterface $trick)
    {
        $this->image = new Image($fileName, $ext);
        $this->image->setTrick($trick);

        return $this;
    }
    /**
     * @return ImageInterface
     */
    public function getImage(): ImageInterface
    {
        return $this->image;
    }
}
