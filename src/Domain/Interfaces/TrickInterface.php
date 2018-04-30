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
     * @return \Ramsey\Uuid\UuidInterface
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @return string
     */
    public function getGrp();

    /**
     * @return int
     */
    public function getCreated();

    /**
     * @return int
     */
    public function getUpdated();

    /**
     * @return ArrayCollection
     */
    public function getImage(): ArrayCollection;

    /**
     * @return ArrayCollection
     */
    public function getComment();

    /**
     * @param ArrayCollection $comment
     */
    public function setComment(ArrayCollection $comment): void;

    /**
     * @param int $updated
     *
     * @return int
     */
    public function setUpdated(int $updated);

    /**
     * @param ArrayCollection $image
     *
     * @return mixed
     */
    public function setImage(ArrayCollection $image);
}
