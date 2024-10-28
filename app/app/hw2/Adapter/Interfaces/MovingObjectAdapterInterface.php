<?php

namespace App\hw2\Adapter\Interfaces;

use App\hw2\commands\Vector;
use App\hw2\UObject;

interface MovingObjectAdapterInterface
{
    public function __construct(UObject $object);

    public function getLocation(): Vector;

    public function setLocation(Vector $newValue);

    public function getVelocity(): Vector;
}