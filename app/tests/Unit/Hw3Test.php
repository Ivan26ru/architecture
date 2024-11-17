<?php
declare(strict_types=1);

namespace Tests\Unit;

use App\Hw2\Adapter\MovingObjectAdapter;
use App\Hw2\Commands\MoveCommand;
use App\Hw2\Commands\Vector;
use App\Hw2\UObject;
use App\Hw3\Command\LogCommand;
use App\Hw3\Command\QueueCommand;
use App\Hw3\Dto\CommandDto;
use App\Hw3\Strategy\StrategyOneException;
use App\Hw3\Strategy\StrategyTwoException;
use PHPUnit\Framework\TestCase;

class Hw3Test extends TestCase
{

    /**
     * Тест выброса исключений
     * @return void
     * @dataProvider dataQueueCommand
     */
    public function testQueueCommand($location, $velocity, $strategyException, $exception)
    {
        LogCommand::clearStaticFunction();

        $object = new UObject();
        $object->setMapping('Location', $location);
        $object->setMapping('Location', $location);
        $object->setMapping('Angle', 0);

        $movingObj     = new MovingObjectAdapter($object);
        $movingCommand = new MoveCommand($movingObj);

        QueueCommand::addCommand(commandDto: new CommandDto($movingCommand));

        // Выбрали стратегию для обработки ошибок
        $queueCommand = new QueueCommand($strategyException);

        $queueCommand->execute();
        $result = LogCommand::getLogs();

        $this->assertEquals(expected: $exception, actual: $result);
    }

    public static function dataQueueCommand(): array
    {
        return [
            'Невозможно прочитать начальное положение StrategyOneException' => [
                null,
                new Vector(2, 2),
                new StrategyOneException(),
                ['App\Hw2\Commands\MoveCommand - App\Hw3\Exception\MoveIncorrectPositionException: Не верный тип данных']
            ],
            'Невозможно прочитать начальное положение StrategyTwoException' => [
                null,
                new Vector(2, 2),
                new StrategyTwoException(),
                ['App\Hw2\Commands\MoveCommand - App\Hw3\Exception\MoveIncorrectPositionException: Не верный тип данных']
            ],
            'Невозможно прочитать скорость StrategyOneException'            => [
                new Vector(2, 2),
                null,
                new StrategyOneException(),
                ['App\Hw2\Commands\MoveCommand - App\Hw3\Exception\MoveIncorrectVelocityException: Не корректная скорость Velocity']
            ],
            'Невозможно прочитать Скорость StrategyTwoException'            => [
                new Vector(2, 2),
                null,
                new StrategyTwoException(),
                ['App\Hw2\Commands\MoveCommand - App\Hw3\Exception\MoveIncorrectVelocityException: Не корректная скорость Velocity']
            ]
        ];
    }

    /**
     * Тест добавления команд в очередь
     * @return void
     */
    public function testAddCommandQueueCommand()
    {
        LogCommand::clearStaticFunction();
        $object = new UObject();

        $movingObj     = new MovingObjectAdapter($object);
        $movingCommand = new MoveCommand($movingObj);

        QueueCommand::addCommand(commandDto: new CommandDto($movingCommand));
        QueueCommand::addCommand(commandDto: new CommandDto($movingCommand));

        $expected = 2;

        $this->assertEquals(expected: $expected, actual: count(QueueCommand::$queue),
            message: 'Добавление в очередь не работает');
    }
}