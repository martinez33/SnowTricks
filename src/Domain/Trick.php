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
 * Class Trick.
 */
class Trick implements TrickInterface
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $grp;

    /**
     * @var int
     */
    private $created;

    /**
     * @var int
     */
    private $updated;

    /**
     * @var ArrayCollection
     */
    private $image;

    /**
     * Trick constructor.
     *
     * @param int|null $updated
     * @param array    $images
     */
    public function __construct(
        int $updated = null,
        array $images = []
    ) {
        $this->id = Uuid::uuid4();
        $this->created = time();
        $this->updated = time();
        $this->image = new ArrayCollection($images);
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
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param string $grp
     */
    public function setGrp(string $grp): void
    {
        $this->grp = $grp;
    }

    /**
     * @param int $updated
     */
    public function setUpdated(int $updated): void
    {
        $this->updated = $updated;
    }
}
