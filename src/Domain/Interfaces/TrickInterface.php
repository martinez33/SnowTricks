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
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

interface TrickInterface
{
    /**
     * TrickInterface constructor.
     *
     * @param NewTrickDTOInterface $creationDTO
     */
    public function __construct(NewTrickDTOInterface $creationDTO);

    //public function __construct();


    /**
     * @return ArrayCollection
     */
    public function getComment(): ArrayCollection;

    /**
     * @param ArrayCollection $comment
     */
    public function setComment(ArrayCollection $comment): void;

    /**
     * @return int
     */
    public function getCreated(): int;

    /**
     * @return null|string
     */
    public function getDescription(): ?string;

    /**
     * @param string $description
     */
    public function setDescription(string $description): void;

    /**
     * @return null|string
     */
    public function getGrp(): ?string;

    /**
     * @param string $grp
     */
    public function setGrp(string $grp): void;

    /**
     * @return string
     */
    public function getId(): string;


    /**
     * @return Collection
     */
    public function getImage(): \ArrayAccess;


    /**
     * @return string
     */
    public function getName(): ?string;

    /**
     * @return string
     */
    public function getSlug(): string;

    /**
     * @return int
     */
    public function getUpdated(): int;

    /**
     * @return Collection
     */
    public function getVideo(): Collection;

    /**
     * @param string $description
     * @param string $grp
     * @param array $images
     * @param array $videos
     */
    public function update(string $description, string $grp, array $images, array  $videos);

    /**
     * @param array $images
     */
    //public function addLinkImages(array $images);

    public function addImage(Image $image);

    public function setImage(array $image); //\ArrayAccess $image

    /**
     * @param array $videos
     */
    public function addLinkVideos(array $videos): void;


}
