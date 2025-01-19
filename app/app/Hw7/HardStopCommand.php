<?php

declare(strict_types=1);

namespace  App\Hw7;

class HardStopCommand implements CommandInterface
{
    public function __construct(private readonly ProcessableInterface $context)
    {
    }

    public function execute(): void
    {
        $this->context->setCanContinue(false);
    }
}