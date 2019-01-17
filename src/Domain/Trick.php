<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 29/03/2018
 * Time: 13:37.
 */

namespace App\Domain;

use App\Domain\DTO\Interfaces\NewTrickDTOInterface;
use App\Domain\DTO\ModifTrickDTO;
use App\Domain\Interfaces\TrickInterface;
use App\Helper\RemoveImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @var ArrayCollection
     */
    private $image;

    /**
     * @var string
     *
     * @Assert\NotBlank(groups={"creation"})
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var int
     */
    private $updated;

    /**
     * @var User
     */
    private $user;

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
    public function __construct(NewTrickDTOInterface $creationDTO)
    {
        $this->created = time();
        $this->description = $creationDTO->description;
        $this->grp = $creationDTO->grp;
        $this->id = Uuid::uuid4();
        $this->name = $creationDTO->name;
        $this->slug = $creationDTO->slug;

        $this->image = new ArrayCollection();
        $this->video = new ArrayCollection();

        $this->addLinkImages($creationDTO->image);
        $this->addLinkVideos($creationDTO->video);
    }

    /**
     * @param ModifTrickDTO $modifTrickDTO
     */
    public function update(ModifTrickDTO $modifTrickDTO)
    {
        $this->setDescription($modifTrickDTO->description);
        $this->setGrp($modifTrickDTO->grp);
        $this->setName($modifTrickDTO->name);

        $this->updated = time();

        $this->addLinkImages($modifTrickDTO->image);
        $this->addLinkVideos($modifTrickDTO->video);
    }

    /**
     * @return RemoveImage
     */
    public function removeImage(Image $image)
    {
        $this->image->removeElement($image);
    }

    /**
     * @param Video $video
     */
    public function removeVideo(Video $video)
    {
        $this->video->removeElement($video);
    }

    /**
     * @return ArrayCollection
     */
    public function getComment(): ArrayCollection
    {
        return $this->comment;
    }

    /**
     * @param ArrayCollection $comment
     */
    public function setComment(ArrayCollection $comment): void
    {
        $this->comment = $comment;
    }

    /**
     * @return int
     */
    public function getCreated(): int
    {
        return $this->created;
    }

    /**
     * @return null|string
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
     * @return null|string
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
     * @return string
     */
    public function getId(): string
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
     * @param array
     */
    public function setImage(array $tabImage)
    {
        foreach ($tabImage as $image) {

            $this->image = $image;
            $image->setTrick($this);
        }
    }

    /**
     * @return null|string
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
    public function getSlug(): string
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
     * @return int
     */
    public function getUpdated(): int
    {
        return $this->updated;
    }

    /**
     * @return \ArrayAccess
     */
    public function getVideo(): \ArrayAccess
    {
        return $this->video;
    }

    /**
     * @param \ArrayAccess $video
     */
    public function setVideo(array $video): void
    {
        $this->video = $video;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @param array $images
     */
    public function addLinkImages(array $images)
    {

        foreach ($images as $image) {

            /*if ($this->image->contains($image)) {

                return;
            }*/
            $this->image[] = $image;

            $image->setTrick($this);
        }
    }

    /**
     * @param Image $image
     */
    public function addImage(Image $image)
    {
        if ($this->image->contains($image)) {
            return;
        }
        $this->image = $image;
        //dump($image);
        $image->setTrick($this);
    }

    /**
     * @param array $videos
     */
    public function addLinkVideos(array $videos)
    {
        foreach ($videos as $video) {

            $this->video[] = $video;
            $video->setTrick($this);
        }
    }

    /**
     * @param Video $video
     */
    public function addVideo(Video $video)
    {
        if ($this->video->contains($video)) {
            return;
        }
        $this->video[] = $video;
        $video->setTrick($this);
    }

}
