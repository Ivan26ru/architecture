<?php

namespace App\hw2\commands;

use App\hw2\commands\Interfaces\MovingObjectInterface;
use App\hw2\UObject;

class MovingObjectAdapter implements MovingObjectInterface
{
    static string  $NAME_LOCATION = 'Location';//Текущая позиция
    static string  $NAME_ANGLE    = 'Angle';//Угол
    static string  $NAME_VELOCITY = 'Velocity';//Скорость
    public UObject $object;

    public function __construct(UObject $object)
    {
        $this->object = $object;

        $this->object->setMapping(
            self::$NAME_LOCATION,
            new Vector(0, 0)
        );
    }

    public function setLocation(Vector $newValue): void
    {
        $this->object->setMapping(self::$NAME_LOCATION, $newValue);
    }

    public function getLocation(): Vector
    {
        return $this->object->getMapping(self::$NAME_LOCATION);
    }

    public function getVelocity(): Vector
    {
        $angle    = $this->object->getMapping(self::$NAME_ANGLE);
        $velocity = $this->object->getMapping(self::$NAME_VELOCITY);

        return new Vector(
            $velocity->x * cos($angle ** 2),
            $velocity->y * sin($angle ** 2)
        );
    }
}