<?php

declare(strict_types=1);

namespace App\Hw3\Command;

use App\Hw2\Commands\Interfaces\CommandInterface;
use App\Hw3\Dto\CommandDto;
use Throwable;

final class AttemptsEndedCommand implements CommandInterface
{
    public function __construct(private readonly Throwable $exception, private readonly CommandDto $commandDto)
    {
    }

    public function execute(): void
    {
        echo 'Попытки закончились для исключения ' . $this->exception::class .  ' и команды ' . $this->commandDto::class;
    }
}