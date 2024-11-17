<?php
declare(strict_types=1);

namespace App\Hw4\Command;

use App\Hw2\Commands\Interfaces\CommandInterface;
use App\Hw4\Adapter\Interfaces\BurnFuelInterface;

final readonly class BurnFuelCommand implements CommandInterface
{
    public function __construct(private BurnFuelInterface $BurnFuel) {}

    public function execute(): void
    {
        $nextFuelBurn = $this->BurnFuel->getFuel() - $this->BurnFuel->getFuelConsumption();
        $this->BurnFuel->setFuel($nextFuelBurn);
    }
}