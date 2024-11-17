<?php

namespace App\Hw4\Adapter;

use App\Hw2\UObject;
use App\Hw4\Adapter\Interfaces\CheckFuelInterface;
use App\Hw4\Exception\CheckFuelException;

final readonly class CheckFuelAdapter implements CheckFuelInterface
{

    public function __construct(private UObject $object) {}

    public function checkFuel(): bool
    {
        $fuel = (int) $this->object->getMapping('Fuel');
        if ($fuel <= 0) {
            throw new CheckFuelException("Топливо закончилось {$fuel}");
        }

        return true;
    }
}