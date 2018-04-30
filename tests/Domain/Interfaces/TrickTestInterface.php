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
    public function setUp();
    /**
     * @return mixed
     */
    public function testConstruct();

}