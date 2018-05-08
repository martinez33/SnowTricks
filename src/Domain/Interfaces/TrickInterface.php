<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 29/03/2018
 * Time: 01:16.
 */

namespace App\Domain\Interfaces;

use Doctrine\Common\Collections\ArrayCollection;

interface TrickInterface
{
    /**
     * TrickInterface constructor.
     *
     * @param int|null $updated
     * @param array    $images
     */
    public function __construct(
        string $description,
        string $grp,
        string $name,
        string $slug,
        int $updated = null
    );

    /**
     * @return ArrayCollection
     */
    public function getComment();

    /**
     * @return int
     */
    public function getCreated();

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @return string
     */
    public function getGrp();

    /**
     * @return \Ramsey\Uuid\UuidInterface
     */
    public function getId();

    /**
     * @return \ArrayAccess
     */
    public function getImage(): \ArrayAccess;

    /**
     * @return string
     */
    public function getName();

    /**
     * @return int
     */
    public function getUpdated();

    /**
     * @return \ArrayAccess
     */
    public function getVideo(): \ArrayAccess;

    /**
     * @param ArrayCollection $comment
     */
    public function setComment(ArrayCollection $comment): void;

    /**
     * @param \ArrayAccess $image
     */
    public function setImage(\ArrayAccess $image): void;

    /**
     * @param int $updated
     *
     * @return int
     */
    public function setUpdated(int $updated);

    /**
     * @param \ArrayAccess $video
     */
    public function setVideo(\ArrayAccess $video): void;
}
