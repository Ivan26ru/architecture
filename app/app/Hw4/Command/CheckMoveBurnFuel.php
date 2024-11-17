<?php
declare(strict_types=1);

namespace App\Hw4\Command;

use App\Hw2\Adapter\MovingObjectAdapter;
use App\Hw2\Commands\Interfaces\CommandInterface;
use App\Hw2\Commands\MoveCommand;
use App\Hw2\UObject;
use App\Hw4\Adapter\BurnFuelAdapter;
use App\Hw4\Adapter\CheckFuelAdapter;

final readonly class CheckMoveBurnFuel implements CommandInterface
{
    public function __construct(private UObject $object) {}


    public function execute(): void
    {
        $checkFuelAdapter = new CheckFuelAdapter($this->object);
        $checkFuelCommand = new CheckFuelCommand($checkFuelAdapter);

        $movingAdapter = new MovingObjectAdapter($this->object);
        $movingCommand = new MoveCommand($movingAdapter);

        $BurnFuelAdapter = new BurnFuelAdapter($this->object);
        $BurnFuelCommand = new BurnFuelCommand($BurnFuelAdapter);

        (new MacroCommand([$checkFuelCommand, $movingCommand, $BurnFuelCommand]))->execute();
    }
}