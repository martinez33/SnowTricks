<?php

namespace App\Tests\Entity\Interfaces;

interface TrickInterfaceTest
{
    /**
     * @return string
     */
    public function testGetTrickName();

    /**
     * @return string
     */
    public function testGetTrickDescription();

    /**
     * @return int
     */
    public function testGetTrickGrp();
}