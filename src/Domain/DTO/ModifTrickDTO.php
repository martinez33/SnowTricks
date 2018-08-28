<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 15/05/2018
 * Time: 10:29
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\ModifTrickDTOInterface;

class ModifTrickDTO implements ModifTrickDTOInterface
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
    public function __construct(
        string $name = null,
        string $description = null,
        string $grp,
        array $image,
        array $video
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->grp = $grp;
        //dump($this->image);
        //die;
        $this->image = $image;
        $this->video = $video;
    }

    /**
     * @return array
     */
    public function getImage(): array
    {
        return $this->image;
    }


}