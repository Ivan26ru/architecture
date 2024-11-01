<?php

namespace App\Hw2\Adapter;

use App\Hw2\Adapter\Interfaces\RotatableObjectAdapterInterface;
use App\Hw2\UObject;

class RotatableAdapter implements RotatableObjectAdapterInterface
{
    private static string $NAME_ANGLE     = 'Angle';//Угол
    private static string $NAME_DIRECTION = 'Direction';//Направление

    private int $DIRECTION_NUMBER = 2;

    public function __construct(private UObject $object) {}

    public function getDirection(): int
    {
        return (int) $this->object->getMapping(self::$NAME_DIRECTION);
    }

    public function setDirection(float $direction): void
    {
        $this->object->setMapping(self::$NAME_DIRECTION, $direction);
    }

    public function getAngularVelocity(): int
    {
        return (int) $this->object->getMapping(self::$NAME_ANGLE);
    }

    public function getDirectionsNumber(): int
    {
        return $this->DIRECTION_NUMBER;
    }
}