<?php

declare(strict_types=1);

namespace App\Hw3\Command;

use App\Hw2\Commands\Interfaces\CommandInterface;
use App\Hw3\Dto\CommandDto;

/**
 * Команда, которая повторяет команду выбросившую исключение.
 */
final class RepeatAgainCommand implements CommandInterface
{
    private static array $repeatedCommands = [];

    public function __construct(private readonly CommandDto $commandDto)
    {
    }

    public function execute(): void
    {
        $commandDto = new CommandDto(
            command: $this->commandDto->command,
            countOfAttempts: $this->commandDto->countOfAttempts + 1
        );

        QueueCommand::addCommand(commandDto: $commandDto);
        self::$repeatedCommands[] = $commandDto->command::class;
    }

    public static function getRepeatedCommands(): array
    {
        return self::$repeatedCommands;
    }

    public static function clearStaticCache(): void
    {
        self::$repeatedCommands = [];
    }
}