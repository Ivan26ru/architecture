<?php

declare(strict_types=1);

namespace App\Hw3\Strategy;

use App\Hw3\Dto\CommandDto;
use Throwable;

interface StrategyExceptionInterface
{
    public function run(Throwable $exception, CommandDto $commandDto): void;
}