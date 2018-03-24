<?php

namespace App\Entity\Interfaces;

interface TrickInterface
{
    /**
     * @return string
     */
    public function getTrickName();

    public function getTrickDescription();

    public function getTrickGrp();
}