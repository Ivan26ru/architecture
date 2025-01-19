<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Hw7\BlockingCollection;
use App\Hw7\HardStopCommand;
use App\Hw7\Processable;
use App\Hw7\Processor;
use App\Hw7\SoftStopCommand;
use App\Hw7\TestCommand;

class Hw7Test extends TestCase
{
    /**
     * Тест проверяет правильность выполнения очереди, что поток запущен и обрабатывает команды.
     *
     * @return void
     */
    public function testOne(): void
    {
        $queue = new BlockingCollection();
        $queue->add(new TestCommand());
        $queue->add(new TestCommand());
        $queue->add(new TestCommand());
        $queue->add(new TestCommand());
        $queue->add(new TestCommand());

        $processable = new Processable($queue);
        $processable->setQueue($queue);
        $processor = new Processor($processable);
        $processor->evaluaton();
        $numberOfExecutedCommands = $processor->getNumberOfExecutedCommands();

        $this->assertEquals(
            5,
            $numberOfExecutedCommands,
            'Ожидалось выполнения 5 команд, а выполнилось ' . $numberOfExecutedCommands
        );
    }

    /**
     * Тест проверяет HardStopCommand (после запуска команды поток завершается).
     *
     * @return void
     */
    public function testTwo(): void
    {
        $queue = new BlockingCollection();
        $queue->add(new TestCommand());
        $queue->add(new TestCommand());
        $processable = new Processable($queue);

        $queue->add(new HardStopCommand($processable));
        $queue->add(new TestCommand());
        $queue->add(new TestCommand());
        $queue->add(new TestCommand());
        $processable->setQueue($queue);

        $processor = new Processor($processable);
        $processor->evaluaton();
        $numberOfExecutedCommands = $processor->getNumberOfExecutedCommands();

        $this->assertEquals(
            3,
            $numberOfExecutedCommands,
            'HardStopCommand неверно работает, ожидалось выполнения 3-х команд, а выполнилось ' . $numberOfExecutedCommands
        );
    }

    /**
     * Тест проверяет SoftStopCommand (поток завершается только после того, как все задачи закончились).
     *
     * @return void
     */
    public function testThree(): void
    {
        $queue = new BlockingCollection();
        $queue->add(new TestCommand());
        $queue->add(new TestCommand());
        $processable = new Processable($queue);

        $queue->add(new SoftStopCommand($processable));
        $processable->setQueue($queue);

        $processor = new Processor($processable);
        $processor->evaluaton();

        $numberOfExecutedCommands = $processor->getNumberOfExecutedCommands();
        $this->assertEquals(
            3,
            $numberOfExecutedCommands,
            'SoftStopCommand неверно работает, ожидалось выполнения 3-х команд, а выполнилось ' . $numberOfExecutedCommands
        );

        // Добавим в очередь новые команды и попробуем запустить
        $queue->add(new TestCommand());
        $queue->add(new TestCommand());
        $processable->setQueue($queue);

        $processor = new Processor($processable);
        $processor->evaluaton();

        $numberOfExecutedCommands = $processor->getNumberOfExecutedCommands();
        $this->assertEquals(
            0,
            $numberOfExecutedCommands,
            'SoftStopCommand неверно работает, ожидалось выполнения 0 команд, а выполнилось ' . $numberOfExecutedCommands
        );
    }
}