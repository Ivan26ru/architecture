<?php

declare(strict_types=1);

namespace App\Hw3\ExceptionHandler;

use App\Hw2\Commands\Interfaces\CommandInterface;
use Throwable;

final class MoveIncorrectPositionExceptionHandler implements ExceptionHandlerInterface
{
    public function __construct(private readonly Throwable $exception, private readonly CommandInterface $command)
    {

    }

    public function execute(): void
    {
        echo '<br>Некорректная позиция ' . $this->command::class . ' выполнилась с ошибкой: ' . $this->exception->getMessage();
    }
}