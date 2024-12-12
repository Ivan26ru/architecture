<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Hw2\Commands\Vector;
use App\Hw2\UObject;
use App\Hw4\Adapter\BurnFuelAdapter;
use App\Hw4\Command\BurnFuelCommand;
use App\Hw4\Command\ChangeVelocityCommand;
use App\Hw5\IoC\IoC;
use PHPUnit\Framework\TestCase;

class Hw5Test extends TestCase
{

    /**
     * Регистрация зависимостей
     * @return void
     * @throws \Exception
     */
    public function testRegisterDependency()
    {
        $ioc = $this->getIoCRegisterBurnCommand();

        $burnCommand = $ioc->resolve(BurnFuelCommand::class);

        $this->assertEquals(BurnFuelCommand::class, $burnCommand::class, 'Не удалось найти зависимость в IoC');
    }

    /**
     * Тест когда не смогли найти зависимость в IoC
     * @return void
     */
    public function testNoneDependencyForIoc()
    {

        try {
            $ioc = $this->getIoCRegisterBurnCommand();
            $ioc->resolve(BurnFuelCommand::class)->execute();
            $ioc->resolve(ChangeVelocityCommand::class);
        } catch (\Exception $e) {
            $this->assertEquals(
                expected: 'Зависимость '.ChangeVelocityCommand::class.' не зарегистрирована.',
                actual: $e->getMessage(),
                message: 'Исключение не нахождения зависимости не верное');
        }
    }

    public function testGetDependencyIoc()
    {
        $ioc = $this->getIoCRegisterBurnCommand();



    }

    private function getIoCRegisterBurnCommand(): IoC
    {
        $ioc = new IoC();

        $position = new Vector(12, 5);
        $velocity = new Vector(-7, 3);

        //Начальные значения объекта
        $uObject = new UObject();
        $uObject->setMapping('Location', $position);
        $uObject->setMapping('Velocity', $velocity);
        $uObject->setMapping('Fuel', 1);

        //Сжигание топлива
        $burnFuelAdapter = new BurnFuelAdapter($uObject);

        $ioc->resolve(IoC::IOC_REGISTER, BurnFuelCommand::class, function () use ($burnFuelAdapter) {
            return new BurnFuelCommand($burnFuelAdapter);
        });

        $burnFuelCommand = $ioc->resolve(BurnFuelCommand::class);
        $burnFuelCommand->execute();

        return $ioc;
    }
}