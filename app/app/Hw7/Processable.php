<?php

declare(strict_types=1);

namespace App\Hw7;

class Processable implements ProcessableInterface
{
    private bool $canContinue = true;

    public function __construct(private BlockingCollection $queue)
    {

    }

    public function canContinue(): bool
    {
        return $this->canContinue;
    }

    public function setCanContinue(bool $canContinue): void
    {
        $this->canContinue = $canContinue;
    }

    public function getQueue(): BlockingCollection
    {
        return $this->queue;
    }

    public function setQueue(BlockingCollection $queue): void
    {
        $this->queue = $queue;
    }

    public function process(callable $func): void
    {
        $func();
    }
}