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
     * @var string
     */
    private $slug;

    /**
     * TrickBuilder constructor.
     *
     * @param TrickInterface  $trick
     * @param string          $name
     * @param string          $description
     * @param string          $grp
     */
    public function create(
        string $name,
        string $description,
        string $grp,
        string $slug
    ) {
        $this->trick = new Trick($description, $grp, $name, $slug);

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
