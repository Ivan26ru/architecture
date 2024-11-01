<?php

declare(strict_types=1);

namespace App\Hw3\ExceptionHandler;

use App\Hw2\Commands\Interfaces\CommandInterface;
use App\Hw3\Dictionary\ExceptionHandlerDictionary;
use App\Hw3\Exception\NotFoundHandlerException;
use Throwable;

class ExceptionHandler
{
    /**
     * Перенаправление ошибки конкретному обработчику через словарь.
     *
     * @param Throwable        $exception
     * @param CommandInterface $command
     * @return void
     * @throws NotFoundHandlerException
     */
    public static function handle(Throwable $exception, CommandInterface $command): void
    {
        ExceptionHandlerDictionary::getHandler($exception, $command)->execute();
    }
}