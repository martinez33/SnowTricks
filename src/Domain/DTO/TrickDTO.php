<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 10/04/2018
 * Time: 02:58
 */

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\NewTrickDTOInterface;

/**
 * Class TrickDTO
 *
 * @package App\Domain\DTO
 */
class TrickDTO implements NewTrickDTOInterface
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
     * @var string
     */
    public $slug;

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
        string $grp = null,
        array $image = null,
        array $video = null
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->grp = $grp;
        $this->image = $image;
        $this->video = $video;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getGrp(): ?string
    {
        return $this->grp;
    }

    /**
     * @param string $grp
     */
    public function setGrp(string $grp): void
    {
        $this->grp = $grp;
    }

    /**
     * @return array
     */
    public function getImage(): ?array
    {
        return $this->image;
    }

    /**
     * @param array $image
     */
    public function setImage(array $image): void
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return array
     */
    public function getVideo(): ?array
    {
        return $this->video;
    }

    /**
     * @param array $video
     */
    public function setVideo(array $video): void
    {
        $this->video = $video;
    }
}
