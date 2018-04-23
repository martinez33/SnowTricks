<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 29/03/2018
 * Time: 13:37.
 */

namespace App\Domain;

use App\Domain\Interfaces\TrickInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;

/**
 * Class Trick
 *
 * @package App\Domain
 */
class Trick implements TrickInterface
{
    /**
    * @var ArrayCollection
    */
    private $comment;

    /**
     * @var int
     */
    private $created;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $grp;

    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    private $id;

    /**
     * @var ArrayCollection
     */
    private $image;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var int
     */
    private $updated;
    /**
     * @var ArrayCollection
     */
    private $video;

    /**
     * Trick constructor.
     *
     * @param ArrayCollection             $comment
     * @param int                         $created
     * @param string                      $description
     * @param string                      $grp
     * @param \Ramsey\Uuid\UuidInterface  $id
     * @param ArrayCollection             $image
     * @param string                      $name
     * @param string                      $slug
     * @param int                         $updated
     */
    public function __construct(
        string $description,
        string $grp,
        string $name,
        string $slug,
        int $updated = null
    ) {
        $this->created = time();
        $this->description = $description;
        $this->grp = $grp;
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->slug = $slug;
        $this->updated = time();
    }


    /**
     * @return \Ramsey\Uuid\UuidInterface
     */
    public function getId(): \Ramsey\Uuid\UuidInterface
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getGrp(): string
    {
        return $this->grp;
    }

    /**
     * @return int
     */
    public function getCreated(): int
    {
        return $this->created;
    }

    /**
     * @return int
     */
    public function getUpdated(): int
    {
        return $this->updated;
    }

    /**
     * @return ArrayCollection
     */
    public function getImage(): ArrayCollection
    {
        return $this->image;
    }

    /**
     * @return ArrayCollection
     */
    public function getComment(): ArrayCollection
    {
        return $this->comment;
    }

    /**
     * @return ArrayCollection
     */
    public function getVideo(): ArrayCollection
    {
        return $this->video;
    }


    /**
     * @param int $updated
     */
    public function setUpdated(int $updated): void
    {
        $this->updated = $updated;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param ArrayCollection $image
     */
    public function setImage(ArrayCollection $image): void
    {
        $this->image = $image;
    }

    /**
     * @param ArrayCollection $video
     */
    public function setVideo(ArrayCollection $video): void
    {
        $this->video = $video;
    }

}
