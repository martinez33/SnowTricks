<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 10/04/2018
 * Time: 02:58
 */

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\NewTrickDTOInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class NewTrickDTO
 *
 * @package App\Domain\DTO
 */
class NewTrickDTO implements NewTrickDTOInterface
{
    /**
     * @var string
     *
     * @Assert\NotBlank(groups={"creation"})
     */
    public $name;

    /**
     * @var string
     *
     * @Assert\NotBlank(groups={"creation"})
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
    public function __construct(string $name = null, string $description = null, string $grp, array $image, array $video)
    {
        $this->name = $name;
        $this->description = $description;
        $this->grp = $grp;
        $this->image = $image;
        $this->video = $video;
    }
}
