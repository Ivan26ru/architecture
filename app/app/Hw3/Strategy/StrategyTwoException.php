<?php

declare(strict_types=1);

namespace App\Hw3\Strategy;

use App\Hw3\Command\AttemptsEndedCommand;
use App\Hw3\Command\LogCommand;
use App\Hw3\Command\RepeatAgainCommand;
use App\Hw3\Dto\CommandDto;
use Throwable;

/**
 * Вторая стратегия обработки исключений (ошибок).
 * Пробует повторить команду 3 раза
 */
final class StrategyTwoException implements StrategyExceptionInterface
{
    public function run(Throwable $exception, CommandDto $commandDto): void
    {
        if ($commandDto->countOfAttempts < 3) {
            $command = new RepeatAgainCommand($commandDto);
        } else {
            if ($commandDto->countOfAttempts === 3) {
                $command = new LogCommand($exception, $commandDto);
            } else {
                $command = new AttemptsEndedCommand($exception, $commandDto);
            }
        }

        $command->execute();
    }
}