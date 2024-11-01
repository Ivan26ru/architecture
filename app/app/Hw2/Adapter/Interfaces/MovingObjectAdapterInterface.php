<?php

namespace App\Hw2\Adapter\Interfaces;

use App\Hw2\Commands\Vector;
use App\Hw2\UObject;

interface MovingObjectAdapterInterface
{
    public function __construct(UObject $object);

    public function getLocation(): Vector;

    public function setLocation(Vector $newValue);

    public function getVelocity(): Vector;

    public function setVelocity(Vector $newValue): void;
}