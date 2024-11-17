<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Hw2\Commands\Vector;
use App\Hw2\UObject;
use App\Hw4\Adapter\BurnFuelAdapter;
use App\Hw4\Adapter\CheckFuelAdapter;
use App\Hw4\Command\BurnFuelCommand;
use App\Hw4\Command\CheckFuelCommand;
use App\Hw4\Command\CheckMoveBurnFuel;
use App\Hw4\Exception\CheckFuelException;
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
            '0 топлива'  => [0, CheckFuelException::class],
            '-1 топлива' => [-1, CheckFuelException::class],
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
                CheckFuelException::class
            ]
        ];
    }
}
