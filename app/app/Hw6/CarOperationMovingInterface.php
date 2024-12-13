<?php

namespace App\Hw6;

use App\Hw2\Commands\Vector;

interface CarOperationMovingInterface
{
    public function getPosition(): Vector;

    public function setPosition(Vector $position): void;

    public function getVelocity(): Vector;
}