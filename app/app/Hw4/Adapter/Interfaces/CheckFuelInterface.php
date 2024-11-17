<?php

declare(strict_types=1);

namespace App\Hw4\Adapter\Interfaces;

use App\Hw2\UObject;
use App\Hw4\Exception\CheckFuelException;

interface CheckFuelInterface
{
    public function __construct(
        UObject $object
    );

    /**
     * @throws CheckFuelException
     */
    public function checkFuel():bool;

}