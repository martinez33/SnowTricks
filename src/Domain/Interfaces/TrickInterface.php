<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 29/03/2018
 * Time: 01:16
 */

namespace App\Domain\Interfaces;

use Doctrine\Common\Collections\ArrayCollection;

interface TrickInterface
{
    /**
     * TrickInterface constructor.
     *
     * @param int|null $updated
     * @param array $images
     */
    public function __construct(
        int $updated = null,
        array $images = []
    );

    /**
     * @return \Ramsey\Uuid\UuidInterface
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @return mixed
     */
    public function getDescription();

    /**
     * @return mixed
     */
    public function getGrp();

    /**
     * @return mixed
     */
    public function getCreated();

    /**
     * @return mixed
     */
    public function getUpdated();

    /**
     * @return ArrayCollection
     */
    public function getImage(): ArrayCollection;

    /**
 * @param $name
 * @return mixed
 */
    public function setName(string $name);

    /**
     * @param $description
     * @return mixed
     */
    public function setDescription(string $description);

    /**
 * @param $grp
 * @return mixed
 */
    public function setGrp(string $grp);

    /**
     * @param int $updated
     * @return int
     */
    public function setUpdated(int $updated);
}