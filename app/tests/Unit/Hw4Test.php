<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Hw2\Commands\Vector;
use App\Hw2\UObject;
use App\Hw4\Adapter\BurnFuelAdapter;
use App\Hw4\Adapter\CheckFuelAdapter;
use App\Hw4\Adapter\VelocityChangeableAdapter;
use App\Hw4\Command\BurnFuelCommand;
use App\Hw4\Command\ChangeVelocityCommand;
use App\Hw4\Command\CheckFuelCommand;
use App\Hw4\Command\CheckMoveBurnFuel;
use App\Hw4\Command\RotateWithChangeVelocityCommand;
use App\Hw4\Exception\CommandException;
use Exception;
use PHPUnit\Framework\TestCase;

class Hw4Test extends TestCase
{

    /**
     * Проверка достаточного количества топлива
     * @return void
     * @dataProvider dataCheckFuel
     */
    public function testCheckFuel($a, $expected)
    {
        $uObject = new UObject();

        $uObject->setMapping('Fuel', $a);
        $checkFuelAdapter = new CheckFuelAdapter($uObject);
        $result           = 'Топливо есть';

        try {
            (new CheckFuelCommand($checkFuelAdapter))->execute();
        } catch (Exception $e) {
            $result = get_class($e);
        }

        $this->assertEquals($expected, $result, 'Тест на достаточное количество топлива не пройден');
    }

    public static function dataCheckFuel(): array
    {
        return [
            '0 топлива'  => [0, CommandException::class],
            '-1 топлива' => [-1, CommandException::class],
            '1 топлива'  => [1, 'Топливо есть'],
        ];
    }

    /**
     * Расход топлива
     * @return void
     */
    public function testBurnFuelCommand()
    {
        $uObject = new UObject();
        $uObject->setMapping('Fuel', 10);

        $burnFuelAdapter = new BurnFuelAdapter($uObject);
        (new BurnFuelCommand($burnFuelAdapter))->execute();

        $this->assertEquals(expected: 9, actual: $uObject->getMapping('Fuel'), message: 'Расход топлива не корректный');
    }

    /**
     * Тест макро команды: топливо есть, передвижение, уменьшение топлива
     *
     * @param $location
     * @param $velocity
     * @param $fuel
     * @param $expected
     *
     * @return void
     *
     * @dataProvider dataCheckMoveBurnFuel
     */
    public function testCheckMoveBurnFuel($location, $velocity, $fuel, $expected)
    {
        $uObject = new UObject();

        $uObject->setMapping('Location', $location);
        $uObject->setMapping('Velocity', $velocity);
        $uObject->setMapping('Fuel', $fuel);

        try {
            (new CheckMoveBurnFuel($uObject))->execute();
            $result = $uObject->mapping;
        } catch (Exception $e) {
            $result = get_class($e);
        }

        $this->assertEquals(expected: $expected, actual: $result,
            message: 'Макрокоманда (проверка топлива, передвижения, уменьшение топлива) не работает');
    }

    public static function dataCheckMoveBurnFuel(): array
    {
        return [
            'Топлива достаточно' => [
                new Vector(2, 2),
                new Vector(4, 4),
                10,
                [
                    'Location' => new Vector(6, 6),
                    'Velocity' => new Vector(4, 4),
                    'Fuel'     => 9,
                    'Angle'    => 0
                ]
            ],
            'Топлива нет'        => [
                new Vector(2, 2),
                new Vector(4, 4),
                0,
                CommandException::class
            ]
        ];
    }

    /**
     * Тест - проверка команды изменения вектора мгновенной скорости (ChangeVelocityCommand)
     *
     * @param $velocity
     * @param $newVelocity
     * @param $expected
     *
     * @return void
     * @dataProvider dataChangeVelocity
     */
    public function testChangeVelocity($velocity, $newVelocity, $expected)
    {
        $uObject = new UObject();

        $uObject->setMapping('Velocity', $velocity);

        $velocityObjectAdapter = new VelocityChangeableAdapter($uObject);
        try {
            (new ChangeVelocityCommand($velocityObjectAdapter, $newVelocity))->execute();
            $result = $uObject->getMapping('Velocity');
        } catch (Exception $e) {
            $result = get_class($e);
        }

        $this->assertEquals(expected: $expected, actual: $result,
            message: 'Команда изменения скорости не корректна');
    }

    public static function dataChangeVelocity(): array
    {
        return [
            'Местоположение не корректное'  => [
                null,
                new Vector(2, 2),
                CommandException::class
            ],
            'Изменение мгновенной скорости' => [
                new Vector(0, 0),
                new Vector(2, 2),
                new Vector(2, 2),
            ]
        ];
    }

    /**
     * Команда для изменения поворота с измененным вектором мгновенной скорости.
     *
     * @param $position
     * @param $velocity
     * @param $newVelocity
     * @param $direction
     * @param $angularVelocity
     * @param $directionNumber
     * @param $expected
     *
     * @return void
     *
     * @dataProvider dataRotateWithChangVelocity()
     */
    public function testRotateWithChangVelocity(
        $position,
        $velocity,
        $newVelocity,
        $direction,
        $angularVelocity,
        $directionNumber,
        $expected
    ) {
        $uObject = new UObject();
        $uObject->setMapping('Velocity');
        $uObject->setMapping('Location', $position);
        $uObject->setMapping('Velocity', $velocity);
        $uObject->setMapping('Direction', $direction);
        $uObject->setMapping('Angle', $angularVelocity);
        $uObject->setMapping('DirectionNumber', $directionNumber);

        (new RotateWithChangeVelocityCommand($uObject, $newVelocity))->execute();

        $result = $uObject->getMapping('Velocity');
        $this->assertEquals(expected: $expected, actual: $result,
            message: 'Поворот с изменением мгновенной скорости(Velocity) не удался');
    }


    public function dataRotateWithChangVelocity(): array
    {
        return [
            'Верные данные' => [
                new Vector(12, 5), //$position
                new Vector(-7, 3), //$velocity
                new Vector(5, 3), //$newVelocity
                100, //$direction
                12, //$angularVelocity
                2, //$directionNumber
                new Vector(5, 3), // $expected
            ],
        ];
    }
}
