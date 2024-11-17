<?php

declare(strict_types=1);

namespace App\Hw4\Adapter;

use App\Hw2\Commands\Vector;
use App\Hw2\UObject;
use App\Hw4\Adapter\Interfaces\VelocityChangeableInterface;

final class VelocityChangeableAdapter implements VelocityChangeableInterface
{
    private const VELOCITY_PROPERTY = 'Velocity';

    public function __construct(private readonly UObject $object) {}

    public function getVelocity(): ?Vector
    {
        return $this->object->getMapping(key: self::VELOCITY_PROPERTY);
    }

    public function setVelocity(Vector $velocity): void
    {
        $this->object->setMapping(key: self::VELOCITY_PROPERTY, value: $velocity);
    }
}