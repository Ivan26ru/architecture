<?php

namespace App\hw2\Adapter\Interfaces;

use App\hw2\Commands\Vector;
use App\hw2\UObject;

interface RotatableObjectAdapterInterface
{
    public function __construct(UObject $object);

    /**
     * Получить направление
     * @return int
     */
    public function getDirection(): int;

    /**
     * Установить направление
     * @param  float  $direction
     *
     * @return void
     */
    public function setDirection(float $direction): void;

    /**
     * Угол вектора
     * @return int
     */
    public function getAngularVelocity(): int;

    /**
     * Что-то вроде округления
     * @return int
     */
    public function getDirectionsNumber(): int;
}