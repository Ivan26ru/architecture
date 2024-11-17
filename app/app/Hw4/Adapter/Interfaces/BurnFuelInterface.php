<?php
declare(strict_types=1);

namespace App\Hw4\Adapter\Interfaces;

interface BurnFuelInterface
{
    public function getFuel(): int;

    public function setFuel(int $valueFuel): void;

    public function getFuelConsumption(): int;
}