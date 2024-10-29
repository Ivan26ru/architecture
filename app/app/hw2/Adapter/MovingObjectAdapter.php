<?php

namespace App\hw2\Adapter;

use App\hw2\Adapter\Interfaces\MovingObjectAdapterInterface;
use App\hw2\commands\Vector;
use App\hw2\UObject;

class MovingObjectAdapter implements MovingObjectAdapterInterface
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
            x: $velocity->x,
            y: $velocity->y
        );
    }
}