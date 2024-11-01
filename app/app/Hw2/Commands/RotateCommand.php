<?php

namespace App\Hw2\Commands;

use App\Hw2\Adapter\RotatableAdapter;
use App\Hw2\Commands\Interfaces\CommandInterface;

/**
 * Команда для поворота вокруг оси.
 */
class RotateCommand implements CommandInterface
{
    public function __construct(private RotatableAdapter $rotatableObject) {}

    public function execute(): void
    {
        $this->rotatableObject->setDirection(
            (
                $this->rotatableObject->getDirection() + $this->rotatableObject->getAngularVelocity()
            )
//            % $this->rotatableObject->getDirectionsNumber()
        );
    }
}