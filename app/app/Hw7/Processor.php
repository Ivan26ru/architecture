<?php

declare(strict_types=1);

namespace App\Hw7;

class Processor
{
    /** @var int Количество выполненных команд */
    private int $numberOfExecutedCommands = 0;

    public function __construct(private readonly ProcessableInterface $context)
    {
    }

    public function evaluaton(): void
    {
        $queue = $this->context->getQueue();

        while ($this->context->canContinue()) {
            $this->context->process(function () use($queue) {
                $cmd = $queue->take();

                // Для примера не будем использовать режим демона и когда заканчивается очередь останавливаем процесс
                if (null === $cmd) {
                    $this->context->setCanContinue(false);
                } else {
                    $this->numberOfExecutedCommands++;
                    $cmd->execute();
                }
            });
        }
    }

    public function getNumberOfExecutedCommands(): int
    {
        return $this->numberOfExecutedCommands;
    }
}