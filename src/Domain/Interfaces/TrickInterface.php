<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 29/03/2018
 * Time: 01:16.
 */

namespace App\Domain\Interfaces;

use App\Domain\DTO\Interfaces\NewTrickDTOInterface;
use App\Domain\Video;
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


    /**
     * @return ArrayCollection
     */
    public function getComment(): ArrayCollection;


    /**
     * @return int
     */
    public function getCreated(): int;


    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @return string
     */
    public function getGrp(): string;


    /**
     * @return string
     */
    public function getId(): string;


    /**
     * @return Collection
     */
    public function getImage(): Collection;


    /**
     * @return string
     */
    public function getName(): string;

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
     * @param ArrayCollection $comment
     */
    public function setComment(ArrayCollection $comment): void;


    /**
     * @param string $description
     */
    public function setDescription(string $description): void;


    /**
     * @param string $grp
     */
    public function setGrp(string $grp): void;


    /**
     * @param array $images
     */
    public function addLinkImages(array $images): void;

    /**
     * @param array $videos
     */
    public function addLinkVideos(array $videos): void;


}
