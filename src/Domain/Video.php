<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 22/04/2018
 * Time: 22:38
 */

namespace App\Domain;



use App\Domain\Interfaces\TrickInterface;
use App\Domain\Interfaces\VideoInterface;
use Ramsey\Uuid\Uuid;

class Video implements VideoInterface
{
    /**
     * @var int
     */
    private $created;

    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $link;

    /**
     * @var TrickInterface
     */
    private $trick;

    /**
     * @var int
     */
    private $updated;

    /**
     * @var string
     */
    private $vidId;

    /**
     * @var string
     */
    private $vidType;

    /**
     * Video constructor.
     * @param string $vidId
     * @param string $vidType
     * @param string $link
     * @param int|null $updated
     * @throws \Exception
     */
    public function __construct(
        /*string $vidId,
        string $vidType,
        string $link,
        int $updated = null*/
    ) {
        $this->created = time();
        $this->id = Uuid::uuid4();
       // $this->updated = time();
        /*$this->vidId = $vidId;
        $this->vidType = $vidType;
        $this->link = $link;*/
    }


    /**
     * @return int
     */
    public function getCreated(): int
    {
        return $this->created;
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
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return TrickInterface
     */
    public function getTrick(): ?TrickInterface
    {
        return $this->trick;
    }

    /**
     * @param int $updated
     */
    public function setUpdated(int $updated): void
    {
        $this->updated = $updated;
    }

    /**
     * @return int
     */
    public function getUpdated(): int
    {
        return $this->updated;
    }

    /**
     * @param TrickInterface $trick
     */
    public function setTrick(TrickInterface $trick): void
    {
        $this->trick = $trick;
    }

    /**
     * @param string $vidId
     */
    public function setVidId(string $vidId): void
    {
        $this->vidId = $vidId;
    }

    /**
     * @return string
     */
    public function getVidId(): ?string
    {
        return $this->vidId;
    }

    /**
     * @param string $vidType
     */
    public function setVidType(string $vidType): void
    {
        $this->vidType = $vidType;
    }

    /**
     * @return string
     */
    public function getVidType(): string
    {
        return $this->vidType;
    }
}
