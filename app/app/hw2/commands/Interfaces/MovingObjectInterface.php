<?php

namespace App\hw2\commands\Interfaces;

use App\hw2\commands\Vector;
use App\hw2\UObject;

interface MovingObjectInterface
{
    public function __construct(UObject $object);

    public function getLocation(): Vector;

    public function setLocation(Vector $newValue);

    public function getVelocity(): Vector;
}