<?php

namespace App\Hw2\Adapter\Interfaces;

use App\Hw2\Commands\Vector;
use App\Hw2\UObject;

interface MovingObjectAdapterInterface
{
    public function __construct(UObject $object);

    /**
     * Текущая позиция
     * @return Vector
     */
    public function getLocation(): Vector;

    /**
     * Установить текущую позицию
     * @param  Vector  $newValue
     *
     * @return mixed
     */
    public function setLocation(Vector $newValue);

    /**
     * Получить скорость
     * @return Vector
     */
    public function getVelocity(): Vector;

    /**
     * Установить скорость
     * @param  Vector  $newValue
     *
     * @return void
     */
    public function setVelocity(Vector $newValue): void;
}