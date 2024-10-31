<?php

namespace App\hw2\Commands;

use App\hw2\Adapter\Interfaces\MovingObjectAdapterInterface;
use App\hw2\Commands\Interfaces\CommandInterface;

class MoveCommand implements CommandInterface
{
    public function __construct(private MovingObjectAdapterInterface $movingObject) {}

    public function execute(): void
    {
        $this->movingObject->setLocation(
            Vector::add(
                $this->movingObject->getLocation(),
                $this->movingObject->getVelocity()
            )
        );
    }
}