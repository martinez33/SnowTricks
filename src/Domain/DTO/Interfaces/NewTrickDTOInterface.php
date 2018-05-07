<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 12/04/2018
 * Time: 01:53
 */
namespace App\Domain\DTO\Interfaces;

interface NewTrickDTOInterface
{
    /**
     * NewTrickDTOInterface constructor.
     *
     * @param string $name
     * @param string $description
     * @param string $grp
     * @param NewImageDTOInterface $image
     * @param array $video
     */
    public function __construct(string $name, string $description, string $grp, array $image, array $video);
}
