<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 14/04/2018
 * Time: 22:52
 */

namespace App\Domain\Builder;

use App\Domain\Builder\Interfaces\TrickBuilderInterface;
use App\Domain\Interfaces\TrickInterface;
use App\Domain\Trick;

class TrickBuilder implements TrickBuilderInterface
{
    /**
     * @var TrickInterface
     */
    private $trick;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $grp;

    /**
     * @var array
     */
    private $images;

    /**
     * @var string
     */
    private $slug;

    /**
     * @param string $description
     * @param string $grp
     * @param string $name
     * @param array $images
     * @param string $slug
     * @return TrickInterface|Trick
     */
    public function createTrick(
        string $description,
        string $grp,
        string $name,
        string $slug,
        array $images
    ) {
        $this->trick = new Trick($description, $grp, $name, $slug, $images);

        return $this->trick;
    }


    /**
     * @return TrickInterface
     */
    public function getTrick(): TrickInterface
    {
        return $this->trick;
    }
}
