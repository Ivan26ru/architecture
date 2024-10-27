<?php

namespace App\hw2\commands;

class Vector
{
    public function __construct(
        public float $x,
        public float $y,
    ) {}

    public static function add(Vector $vectorCurrent, Vector $vectorVelocity): Vector
    {
        $x = $vectorCurrent->x + $vectorVelocity->x;
        $y = $vectorCurrent->y + $vectorVelocity->y;
        return new Vector($x, $y);
    }
}

