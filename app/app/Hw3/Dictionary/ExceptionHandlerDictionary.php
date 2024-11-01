<?php

declare(strict_types=1);

namespace App\Hw3\Dictionary;

use App\Hw2\Commands\Interfaces\CommandInterface;
use App\Hw2\Commands\MoveCommand;
use App\Hw3\Exception\MoveIncorrectPositionException;
use App\Hw3\Exception\MoveIncorrectVelocityException;
use App\Hw3\Exception\NotFoundHandlerException;
use App\Hw3\ExceptionHandler\ExceptionHandlerInterface;
use App\Hw3\ExceptionHandler\MoveIncorrectPositionExceptionHandler;
use App\Hw3\ExceptionHandler\MoveIncorrectVelocityExceptionHandler;
use Throwable;

final class ExceptionHandlerDictionary
{
    /**
     * @param Throwable        $exception
     * @param CommandInterface $command
     * @return ExceptionHandlerInterface
     * @throws NotFoundHandlerException
     */
    public static function getHandler(Throwable $exception, CommandInterface $command): ExceptionHandlerInterface
    {
        $exceptionClass = $exception::class;
        $commandClass = $command::class;
        $handlerClass = self::getStructureHandler()[$exceptionClass][$commandClass] ?? false;

        if (false === $handlerClass) {
            throw new NotFoundHandlerException("Не удалось найти обработчик ошибки: $exceptionClass и команды $commandClass.");
        }

        return new $handlerClass($exception, $command);
    }

    /**
     * Маппинг исключений к обработчикам
     * @return array
     */
    private static function getStructureHandler(): array
    {
        $structureHandler = [];

        //Вручную сопоставление идет, не зависимо от названия файла
        $structureHandler[MoveIncorrectPositionException::class][MoveCommand::class] = MoveIncorrectPositionExceptionHandler::class;
        $structureHandler[MoveIncorrectVelocityException::class][MoveCommand::class] = MoveIncorrectVelocityExceptionHandler::class;

        return $structureHandler;
    }
}