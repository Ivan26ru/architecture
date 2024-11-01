<?php

declare(strict_types=1);

namespace App\Hw3\Dto;


use App\Hw2\Commands\Interfaces\CommandInterface;

final class CommandDto
{
    public function __construct(public readonly CommandInterface $command, public readonly int $countOfAttempts = 1)
    {
    }
}