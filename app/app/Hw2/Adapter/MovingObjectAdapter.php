<?php
declare(strict_types=1);

namespace App\Hw2\Adapter;

use App\Hw2\Adapter\Interfaces\MovingObjectAdapterInterface;
use App\Hw2\Commands\Vector;
use App\Hw2\UObject;
use App\Hw3\Exception\MoveIncorrectPositionException;
use App\Hw3\Exception\MoveIncorrectVelocityException;

final class MovingObjectAdapter implements MovingObjectAdapterInterface
{
    static string $NAME_LOCATION = 'Location';//Текущая позиция
    static string $NAME_ANGLE    = 'Angle';//Угол
    static string $NAME_VELOCITY = 'Velocity';//Скорость

    public function __construct(public readonly UObject $object) {}

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

    /**
     * @throws MoveIncorrectPositionException
     */
    public function getLocation(): Vector
    {
        $location = $this->object->getMapping(self::$NAME_LOCATION);
        if ($location instanceof Vector) {
            return $location;
        } else {
            throw new MoveIncorrectPositionException("Не верный тип данных");
        }
    }

    /**
     * @throws MoveIncorrectVelocityException
     */
    public function getVelocity(): Vector
    {
        $angle    = $this->object->getMapping(self::$NAME_ANGLE);
        $velocity = $this->object->getMapping(self::$NAME_VELOCITY);

        if ($velocity instanceof Vector) {
            return new Vector(
                x: $velocity->x,
                y: $velocity->y
            );
        } else {
            throw new MoveIncorrectVelocityException("Не корректная скорость Velocity");
        }

    }
}