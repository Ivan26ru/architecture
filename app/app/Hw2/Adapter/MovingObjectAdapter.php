<?php

namespace App\Hw2\Adapter;

use App\Hw2\Adapter\Interfaces\MovingObjectAdapterInterface;
use App\Hw2\Commands\Vector;
use App\Hw2\UObject;
use App\Hw3\Exception\MoveIncorrectPositionException;

class MovingObjectAdapter implements MovingObjectAdapterInterface
{
    static string  $NAME_LOCATION = 'Location';//Текущая позиция
    static string  $NAME_ANGLE    = 'Angle';//Угол
    static string  $NAME_VELOCITY = 'Velocity';//Скорость
    public UObject $object;

    public function __construct(UObject $object)
    {
        $this->object = $object;
    }

    public function setLocation(Vector $newValue): void
    {
        if (true === is_nan($newValue->x)) {
            throw new MoveIncorrectPositionException('Координата x не число');
        }
        if (true === is_nan($newValue->y)) {
            throw new MoveIncorrectPositionException('Координата y не число');
        }
        $this->object->setMapping(self::$NAME_LOCATION, $newValue);
    }

    public function setVelocity(Vector $newValue): void
    {
        $this->object->setMapping(self::$NAME_VELOCITY, $newValue);
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