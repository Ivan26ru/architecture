<?php

declare(strict_types=1);

namespace App\Hw7;

class SoftStopCommand implements CommandInterface
{
    public function __construct(private readonly ProcessableInterface $context)
    {
    }

    public function execute(): void
    {
        $queue = $this->context->getQueue();

        // Выполняем команды, которые были уже в очереди и останавилваем полностью
        while ($this->context->canContinue()) {
            $this->context->process(function () use($queue) {
                $cmd = $queue->take();

                if (null === $cmd) {
                    $this->context->setQueue(new BlockingCollection());
                    $this->context->setCanContinue(false);
                } else {
                    $cmd->execute();
                }
            });
        }
    }
}