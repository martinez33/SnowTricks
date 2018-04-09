<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 06/04/2018
 * Time: 22:39
 */

namespace App\Tests\Domain\Interfaces;

interface TrickTestInterface
{
    /**
     * @return string
     */
    public function testGetId();

    /**
     * @return string
     */
    public function testGetName();

    /**
     * @return string
     */
    public function testGetDescription();

    /**
     * @return int
     */
    public function testGetCreated();

    /**
     * @return int
     */
    public function testGetUpdated();

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function testGetImage();
}