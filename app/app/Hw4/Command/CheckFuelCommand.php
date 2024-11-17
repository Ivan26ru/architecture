<?php
declare(strict_types=1);

namespace App\Hw4\Command;

use App\Hw2\Commands\Interfaces\CommandInterface;
use App\Hw4\Adapter\Interfaces\CheckFuelInterface;

final readonly class CheckFuelCommand implements CommandInterface
{
    public function __construct(private CheckFuelInterface $checkFuel) {}

    public function execute(): void
    {
        $this->checkFuel->checkFuel();
    }
}