<?php

declare(strict_types=1);

namespace App\Hw3\Strategy;

use App\Hw3\Command\LogCommand;
use App\Hw3\Command\RepeatAgainCommand;
use App\Hw3\Dto\CommandDto;
use Throwable;

/**
 * Первая стратегия обработки исключений (ошибок).
 */
final class StrategyOneException implements StrategyExceptionInterface
{
    public function run(Throwable $exception, CommandDto $commandDto): void
    {
        $command = $commandDto->countOfAttempts === 1 ? new RepeatAgainCommand($commandDto) : new LogCommand($exception, $commandDto);
        $command->execute();
    }
}