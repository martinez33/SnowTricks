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
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Trick
 *
 * @package App\Domain
 *
 * @UniqueEntity("name")
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
     * @var \ArrayAccess
     */
    private $image;

    /**
     * @var string
     *
     * @Assert\NotBlank(groups={"creation"})
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
     * @param string $description
     * @param string $grp
     * @param string $name
     * @param string $slug
     * @param int|null $updated
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
     * @return ArrayCollection
     */
    public function getComment(): ArrayCollection
    {
        return $this->comment;
    }

    /**
     * @return int
     */
    public function getCreated(): int
    {
        return $this->created;
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
     * @return \Ramsey\Uuid\UuidInterface
     */
    public function getId(): \Ramsey\Uuid\UuidInterface
    {
        return $this->id;
    }

    /**
     * @return \ArrayAccess
     */
    public function getImage(): \ArrayAccess
    {
        return $this->image;
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
    public function getSlug(): string
    {
        return $this->slug;
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
    public function getVideo(): ArrayCollection
    {
        return $this->video;
    }


    /**
     * @param ArrayCollection $comment
     */
    public function setComment(ArrayCollection $comment): void
    {
        $this->comment = $comment;
    }

    /**
     * @param \ArrayAccess $image
     */
    public function setImage(\ArrayAccess $image): void
    {
        $this->image = $image;
    }



    /**
     * @param int $updated
     */
    public function setUpdated(int $updated): void
    {
        $this->updated = $updated;
    }

    /**
     * @param ArrayCollection $video
     */
    public function setVideo(ArrayCollection $video): void
    {
        $this->video = $video;
    }
}
