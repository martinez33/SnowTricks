<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 23/04/2018
 * Time: 11:36
 */

namespace App\Domain\Builder;

use App\Domain\Builder\Interfaces\VideoBuilderInterface;
use App\Domain\Interfaces\TrickInterface;
use App\Domain\Interfaces\VideoInterface;
use App\Domain\Video;

class VideoBuilder implements VideoBuilderInterface
{

    /**
     * @var TrickInterface
     */
    private $trick;

    /**
     * @var VideoInterface
     */
    private $video;

    /**
     * string
     */
    private $vidId;

    /**
     * @var string
     */
    private $vidType;

    public function create(string $vidId, string $vidType, TrickInterface $trick)
    {
        $this->video = new Video($vidId, $vidType);

        $this->video->setTrick($trick);

        return $this;
    }

    /**
     * @return VideoInterface
     */
    public function getVideo(): VideoInterface
    {
        return $this->video;
    }
}
