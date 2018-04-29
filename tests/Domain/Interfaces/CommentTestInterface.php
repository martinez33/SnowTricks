<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 09/04/2018
 * Time: 13:33
 */

namespace App\Tests\Domain\Interfaces;

interface CommentTestInterface
{
    public function testGetId();

    public function testGetContent();

    public function testGetCreated();
}