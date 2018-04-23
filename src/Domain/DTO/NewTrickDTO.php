<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 10/04/2018
 * Time: 02:58
 */

namespace App\Domain\DTO;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class NewTrickDTO
 *
 * @package App\Domain\DTO
 */
class NewTrickDTO
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $grp;

    /**
     * @var array
     */
    public $image = [];

    /**
     * @var array
     */
    public $video = [];


    /**
     * newTrickDTO constructor.
     *
     * @param string $name
     * @param string $description
     * @param string $grp
     */
    public function __construct(string $name, string $description, string $grp, array $image, array $video)
    {
        $this->name = $name;
        $this->description = $description;
        $this->grp = $grp;
        $this->image = $image;
        $this->video = $video;
    }
}
