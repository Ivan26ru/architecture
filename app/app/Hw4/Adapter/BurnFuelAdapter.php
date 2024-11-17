<?php

declare(strict_types=1);

namespace App\Hw4\Adapter;

use App\Hw2\UObject;
use App\Hw4\Adapter\Interfaces\BurnFuelInterface;

final readonly class BurnFuelAdapter implements BurnFuelInterface
{
    public function __construct(private UObject $object) {}

    public function getFuel(): int
    {
        return $this->object->getMapping('Fuel');
    }

    public function setFuel(int $valueFuel): void
    {
        $this->object->setMapping('Fuel', $valueFuel);
    }

    public function getFuelConsumption(): int
    {
        return 1;
    }
}