<?php

declare(strict_types=1);

namespace App\Hw3\ExceptionHandler;

interface ExceptionHandlerInterface
{
    public function execute(): void;
}