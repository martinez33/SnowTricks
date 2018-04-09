<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 29/03/2018
 * Time: 01:16.
 */

namespace App\Domain\Interfaces;

use Doctrine\Common\Collections\ArrayCollection;

interface TrickInterface
{
    /**
     * TrickInterface constructor.
     *
     * @param int|null $updated
     * @param array    $images
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
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @return string
     */
    public function getGrp();

    /**
     * @return int
     */
    public function getCreated();

    /**
     * @return int
     */
    public function getUpdated();

    /**
     * @return ArrayCollection
     */
    public function getImage(): ArrayCollection;

    /**
     * @return ArrayCollection
     */
    public function getComment();

    /**
     * @param $name
     *
     * @return string
     */
    public function setName(string $name);

    /**
     * @param $description
     *
     * @return string
     */
    public function setDescription(string $description);

    /**
     * @param $grp
     *
     * @return string
     */
    public function setGrp(string $grp);

    /**
     * @param int $updated
     *
     * @return int
     */
    public function setUpdated(int $updated);


}
