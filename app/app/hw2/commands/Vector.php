<?php

namespace App\hw2\commands;

class Vector
{
    private array $coordinates;

    public function __construct($coordinateX)
    {
        $this->coordinates = $coordinateX;
    }

    public static function add(Vector $vectorCurrent, Vector $vectorVelocity)
    {
        $resultCoords = array_map(function ($x1, $x2) {
            return $x1 + $x2;
        }, $vectorCurrent->coordinates, $vectorVelocity->coordinates);

        return new Vector($resultCoords);
    }
}

