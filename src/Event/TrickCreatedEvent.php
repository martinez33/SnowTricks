<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 29/04/2018
 * Time: 21:32
 */

namespace App\Event;


use App\Domain\Interfaces\TrickInterface;
use Symfony\Component\EventDispatcher\Event;

class TrickCreatedEvent extends Event
{
    const NAME = 'trick.created';

    /**
     * @var TrickInterface
     */
    private $trick;

    /**
     * TrickCreatedEvent constructor.
     *
     * @param TrickInterface $trick
     */
    public function __construct(TrickInterface $trick)
    {
        $this->trick = $trick;
    }

    /**
     * @return TrickInterface
     */
    public function getTrick(): TrickInterface
    {
        return $this->trick;
    }
}