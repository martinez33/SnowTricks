<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 29/03/2018
 * Time: 01:16.
 */

namespace App\Domain\Interfaces;

use App\Domain\Video;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

interface TrickInterface
{
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
     * @return string
     */
    public function getId();

    /**
     * @return \ArrayAccess
     */
    public function getImage();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getSlug();

    /**
     * @return int
     */
    public function getUpdated();

    /**
     * @return Collection|video
     */
    public function getVideo(): Collection;


    public function update(string $description, string $grp, \ArrayAccess $arrayAccessImg, \ArrayAccess $arrayAccessVid);


    /**
     * @param ArrayCollection $comment
     */
    public function setComment(ArrayCollection $comment);

    /**
     * @param \ArrayAccess $image
     */
    public function setImage(array $image);

    /**
     * @param int $updated
     */
    public function setUpdated(int $updated);

    /**
     * @param \ArrayAccess $video
     */
    //public function setVideo(\ArrayAccess $video);

}
