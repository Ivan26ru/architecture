<?php
declare(strict_types=1);

namespace App\Hw4\Adapter\Interfaces;

use App\Hw2\Commands\Vector;

interface VelocityChangeableInterface
{
    public function getVelocity(): ?Vector;

    public function setVelocity(Vector $velocity): void;
}