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
    public function __construct(
        string $name = null,
        string $description = null,
        string $grp,
        array $image,
        array $video
    );
}
