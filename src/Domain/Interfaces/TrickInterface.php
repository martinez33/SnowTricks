<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 29/03/2018
 * Time: 01:16.
 */

namespace App\Domain\Interfaces;

use App\Domain\DTO\Interfaces\NewTrickDTOInterface;

use App\Domain\Image;
use App\Domain\User;
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
    //public function __construct(NewTrickDTOInterface $creationDTO);

    /**
     * @return ArrayCollection
     */
    public function getComment();

    /**
     * @param ArrayCollection $comment
     */
    public function setComment(ArrayCollection $comment);

    /**
     * @return int
     */
    public function getCreated();

    /**
     * @return null|string
     */
    public function getDescription();

    /**
     * @param string $description
     */
    public function setDescription(string $description);

    /**
     * @return null|string
     */
    public function getGrp();

    /**
     * @param string $grp
     */
    public function setGrp(string $grp);

    /**
     * @return string
     */
    public function getId();

    /**
     * @return \ArrayAccess
     */
    public function getImage();

    /**
     * @param array
     */
    public function setImage(array $tabImage);

    /**
     * @return null|string
     */
    public function getName();

    /**
     * @param string $name
     */
    public function setName(string $name);


    /**
     * @return string
     */
    public function getSlug();

    /**
     * @param string $slug
     */
    public function setSlug(string $slug);


    /**
     * @return int
     */
    public function getUpdated();


    public function getVideo();

    /**
     * @param \ArrayAccess $video
     */
    public function setVideo(array $video);

    /**
     * @param string $description
     * @param string $grp
     * @param array $images
     * @param array $videos
     */
    public function update(string $description, string $grp, array $images, array  $videos);

    /**
     * @return User
     */
    public function getUser();

    /**
     * @param User $user
     * @return mixed
     */
    public function setUser(User $user);

    /**
     * @param array $images
     */
    public function addLinkImages(array $images);

    /**
     * @param Image $image
     */
    public function addImage(Image $image);

    /**
     * @param array $videos
     */
    public function addLinkVideos(array $videos);

}
