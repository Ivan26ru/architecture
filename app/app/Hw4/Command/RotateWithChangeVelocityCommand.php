<?php

namespace App\Hw4\Command;

use App\Hw2\Adapter\RotatableAdapter;
use App\Hw2\Commands\Interfaces\CommandInterface;
use App\Hw2\Commands\RotateCommand;
use App\Hw2\Commands\Vector;
use App\Hw2\UObject;
use App\Hw4\Adapter\VelocityChangeableAdapter;

/**
 * Команда для изменения поворота с измененным вектором мгновенной скорости.
 */
final readonly class RotateWithChangeVelocityCommand implements CommandInterface
{
    public function __construct(private UObject $object, private Vector $newVelocity) {}


    public function execute(): void
    {
        $velocityObjectAdapter = new VelocityChangeableAdapter($this->object);
        $velocityCommand       = new ChangeVelocityCommand($velocityObjectAdapter, $this->newVelocity);

        $rotateAdapter = new RotatableAdapter($this->object);
        $rotateCommand = new RotateCommand($rotateAdapter);

        $macroCommand = new MacroCommand([$velocityCommand, $rotateCommand]);
        $macroCommand->execute();

    }
}