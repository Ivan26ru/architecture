<?php

declare(strict_types=1);

namespace App\Hw3\Command;

use App\Hw2\Commands\Interfaces\CommandInterface;
use App\Hw3\Dto\CommandDto;
use App\Hw3\ExceptionHandler\ExceptionHandler;
use App\Hw3\Strategy\StrategyExceptionInterface;
use Throwable;

/**
 * Обработка исключений через очередь команд
 */
final class QueueCommand implements CommandInterface
{
    /** @var CommandDto[] очередь команд */
    public static array $queue = [];

    public function __construct(private readonly StrategyExceptionInterface $concreteStrategyException) {}

    /**
     * Добавление команд в очередь.
     *
     * Сделано статическим - что б можно было добавлять в любом месте и была единая очередь команд
     *
     * @param  CommandDto  $commandDto
     *
     * @return void
     */
    public static function addCommand(CommandDto $commandDto): void
    {
        self::$queue[] = $commandDto;
    }

    public function execute(): void
    {
        while ([] !== self::$queue) {
            $this->executeIteration();
        }
    }

    private function executeIteration(): void
    {
        foreach (self::$queue as $key => $commandDto) {
            try {
                $command = $commandDto->command;
                $command->execute();
            } catch (Throwable $exception) {
                /** Обработчик под конкретные ошибки */
                ExceptionHandler::handle($exception, $command);

                /** Общая обработка ошибок */
                $this->concreteStrategyException->run($exception, $commandDto);
            } finally {
                unset(self::$queue[$key]);
            }
        }
    }
}