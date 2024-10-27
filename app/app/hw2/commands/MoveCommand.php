<?php

namespace App\hw2\commands;


use App\hw2\commands\Interfaces\CommandInterface;
use App\hw2\commands\Interfaces\MovingObjectInterface;

readonly class MoveCommand implements CommandInterface
{
    public function __construct(private MovingObjectInterface $object) {}

    public function Execute(): void
    {
        $this->object->setLocation(
            Vector::add(
                $this->object->getLocation(),
                $this->object->getVelocity()
            )
        );
    }
}