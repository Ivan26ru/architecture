<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Hw2\Commands\Vector;
use App\Hw2\UObject;
use App\Hw4\Adapter\BurnFuelAdapter;
use App\Hw4\Command\BurnFuelCommand;
use App\Hw4\Command\ChangeVelocityCommand;
use App\Hw5\IoC\IoC;
use Exception;
use PHPUnit\Framework\TestCase;

class Hw5Test extends TestCase
{
    private UObject $uObject;

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
            $ioc->resolve(ChangeVelocityCommand::class);
        } catch (\Exception $e) {
            $this->assertEquals(
                expected: 'Зависимость '.ChangeVelocityCommand::class.' не зарегистрирована.',
                actual: $e->getMessage(),
                message: 'Исключение не нахождения зависимости не верное');
        }
    }


    /**
     * Тест получения зависимости в IoC контейнере
     * @return void
     * @throws \Exception
     */
    public function testGetDependencyIoc()
    {
        $ioc = $this->getIoCRegisterBurnCommand();

        $burnCommand = $ioc->resolve(BurnFuelCommand::class);
        $burnCommand->execute();

        $this->assertEquals(0, $this->uObject->getMapping('Fuel'), 'Команда сжигания топлива не сработала.');
    }


    /**
     * Тест создания новых скоуп
     * @return void
     * @throws \Exception
     */
    public function testCreateNewScope()
    {
        $ioc = $this->getIoCRegisterBurnCommand();

        // Работе с 1 скоупом
        $ioc->resolve(IoC::SCOPES_NEW, 'scope1');
        $ioc->resolve(IoC::SCOPES_CURRENT, 'scope1');

        $ioc = $this->getIoCRegisterBurnCommand($ioc);

        $burnCommand = $ioc->resolve(BurnFuelCommand::class);

        $this->assertEquals(BurnFuelCommand::class, $burnCommand::class,
            'Не удалось найти зависимость в IoC контейнере');

        // Работа со 2 скоупом
        $ioc->resolve(IoC::SCOPES_NEW, 'scope2');
        $ioc->resolve(IoC::SCOPES_CURRENT, 'scope2');

        try {
            $ioc->resolve(BurnFuelCommand::class);
        } catch (Exception $e) {
            $this->assertEquals("Зависимость ".BurnFuelCommand::class." не зарегистрирована.", $e->getMessage(),
                "Ошибка не та, которую ожидаем");
        }


    }

    private function getIoCRegisterBurnCommand(): IoC
    {
        $ioc = new IoC();

        $position = new Vector(12, 5);
        $velocity = new Vector(-7, 3);

        //Начальные значения объекта
        $this->uObject = new UObject();
        $this->uObject->setMapping('Location', $position);
        $this->uObject->setMapping('Velocity', $velocity);
        $this->uObject->setMapping('Fuel', 1);

        //Сжигание топлива
        $burnFuelAdapter = new BurnFuelAdapter($this->uObject);

        $ioc->resolve(IoC::IOC_REGISTER, BurnFuelCommand::class, function () use ($burnFuelAdapter) {
            return new BurnFuelCommand($burnFuelAdapter);
        });

        return $ioc;
    }
}