<?php

namespace App\hw2\commands;


use App\hw2\commands\Interfaces\CommandInterface;
use App\hw2\commands\Interfaces\MovingObjectInterface;

class MoveCommand implements CommandInterface
{
    private MovingObjectInterface $object;

    public function move(MovingObjectInterface $object): void
    {
        $this->object = $object;
    }

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