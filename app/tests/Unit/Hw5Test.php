<?php

namespace Tests\Unit;

use App\Hw2\Commands\Vector;
use App\Hw2\UObject;
use App\Hw4\Adapter\BurnFuelAdapter;
use App\Hw4\Command\BurnFuelCommand;
use App\Hw5\IoC\IoC;
use PHPUnit\Framework\TestCase;

class Hw5Test extends TestCase
{

    public function testHw5One()
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

        return $ioc;
    }
}