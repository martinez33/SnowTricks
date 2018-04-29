<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 07/04/2018
 * Time: 20:39
 */

namespace App\Tests\Domain\Interfaces;

interface ImageTestInterface
{
    /**
     * @return string
     */
    public function testGetId();

    /**
     * @return string
     */
    public function testGetFileName();

    /**
     * @return string
     */
    public function testGetExt();

    /**
     * @return int
     */
    public function testGetCreated();

    /**
     * @return int
     */
    public function testGetUpdated();

}