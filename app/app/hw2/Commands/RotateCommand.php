<?php

namespace App\hw2\Commands;

use App\hw2\Adapter\RotatableAdapter;
use App\hw2\Commands\Interfaces\CommandInterface;

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