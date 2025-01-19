<?php

declare(strict_types=1);

namespace App\Hw7;

interface CommandInterface
{
    public function execute(): void;
}