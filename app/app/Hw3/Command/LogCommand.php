<?php

declare(strict_types=1);

namespace App\Hw3\Command;

use App\Hw2\Commands\Interfaces\CommandInterface;
use App\Hw3\Dto\CommandDto;
use Throwable;

/**
 * Команда, которая записывает информацию о выброшенном исключении.
 */
final class LogCommand implements CommandInterface
{
    /** @var array Накопленные логи */
    private static array $logs = [];

    public function __construct(private readonly Throwable $exception, private readonly CommandDto $commandDto)
    {
    }

    public function execute(): void
    {
        $exceptionClass = $this->exception::class;
        $commandClass = $this->commandDto->command::class;

        $exceptionMessage = $commandClass . ' - ' . $exceptionClass . ': ' . $this->exception->getMessage();
        self::$logs[] = $exceptionMessage;
    }

    public static function getLogs(): array
    {
        return self::$logs;
    }

    public static function clearStaticFunction(): void
    {
        self::$logs = [];
    }
}