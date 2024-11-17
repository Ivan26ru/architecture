<?php

declare(strict_types=1);

namespace App\Hw3\Dto;


use App\Hw2\Commands\Interfaces\CommandInterface;

final readonly class CommandDto
{
    /**
     * @param  CommandInterface  $command  Команда
     * @param  int  $countOfAttempts  Количество попыток
     */
    public function __construct(public CommandInterface $command, public int $countOfAttempts = 1) {}
}