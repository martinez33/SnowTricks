<?php

namespace App\Entity;

use App\Entity\Interfaces\TrickInterface;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Exception\UnsupportedOperationException;
use Ramsey\Uuid\Uuid;


/**
 * @ORM\Entity(repositoryClass="App\Repository\TrickRepository")
 */
class Trick implements TrickInterface
{
    /**
     * @ORM\Id()
     */
    private $trickId;

    /**
     * @var string
     */
    protected $trickName;

    /**
     * @var string
     */
    private $trickDescription;

    /**
     * @var int
     */
    private $trickGrp;

    /**
     * Trick constructor.
     * @param string|null $trickName
     * @param string|null $trickDescription
     * @param int|null $trickGrp
     */
    public function __construct(
        string $trickName = null,
        string $trickDescription = null,
        int $trickGrp = null
    )
    {
        $this->trickId = Uuid::uuid4();
        $this->trickName = $trickName;
        $this->trickDescription = $trickDescription;
        $this->trickGrp = $trickGrp;
    }

    /**
     * @return string
     */
    public function getTrickName(): string
    {
        return $this->trickName;
    }

    /**
     * @return string
     */
    public function getTrickDescription(): string
    {
        return $this->trickDescription;
    }

    /**
     * @return int
     */
    public function getTrickGrp(): int
    {
        return $this->trickGrp;
    }
}
