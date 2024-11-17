<?php

declare(strict_types=1);

namespace App\Hw4\Adapter\Interfaces;

use App\Hw2\UObject;
use App\Hw4\Exception\CommandException;

interface CheckFuelInterface
{
    public function __construct(
        UObject $object
    );

    /**
     * @throws CommandException
     */
    public function checkFuel():bool;

}