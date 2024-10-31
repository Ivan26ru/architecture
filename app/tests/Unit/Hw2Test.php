<?php

use App\hw2\Adapter\MovingObjectAdapter;
use App\hw2\Adapter\RotatableAdapter;
use App\hw2\Commands\MoveCommand;
use App\hw2\Commands\RotateCommand;
use App\hw2\Commands\Vector;
use App\hw2\UObject;
use PHPUnit\Framework\TestCase;

class Hw2Test extends TestCase
{

    /**
     * Для объекта, находящегося в точке (12, 5) и движущегося со скоростью (-7, 3) движение меняет положение объекта на (5, 8)
     * @return void
     */
    public function test_hw2_1()
    {
        $starShip  = new UObject();
        $movingObj = new MovingObjectAdapter($starShip);

        $movingObj->setLocation(new Vector(12, 5));
        $movingObj->setVelocity(new Vector(-7, 3));

        $movingCommand = new MoveCommand($movingObj);
        $movingCommand->execute();

        $this->assertEquals(
            (new Vector(5, 8)),
            $starShip->getMapping('Location'),
            'Тест не прошел: для объекта, находящегося в точке (12, 5) и движущегося со скоростью (-7, 3)
     * движение меняет положение объекта на (5, 8);');

    }

    /**
     * Попытка сдвинуть объект, у которого невозможно прочитать положение в пространстве, приводит к ошибке
     * @return void
     */
    public function test_hw2_2_error()
    {
        $starShip  = new UObject();
        $movingObj = new MovingObjectAdapter($starShip);

        $starShip->setMapping('Location', null);
        $starShip->setMapping('Velocity', new Vector(-7, 3));

        $movingCommand = new MoveCommand($movingObj);
        $this->expectException(Throwable::class);

        $movingCommand->execute();
    }

    /**
     * Попытка сдвинуть объект, у которого невозможно прочитать значение мгновенной скорости, приводит к ошибке
     * @return void
     */
    public function test_hw2_3_error()
    {
        $starShip  = new UObject();
        $movingObj = new MovingObjectAdapter($starShip);

        //        $starShip->setMapping('Location', null);
        //        $starShip->setMapping('Velocity', new Vector(-7, 3));

        $movingCommand = new MoveCommand($movingObj);
        $this->expectException(Throwable::class);

        $movingCommand->execute();
    }

    /**
     * Попытка сдвинуть объект, у которого невозможно прочитать значение мгновенной скорости, приводит к ошибке
     * @return void
     */
    public function test_hw2_4_error()
    {
        $starShip  = new UObject();
        $movingObj = new MovingObjectAdapter($starShip);

        $starShip->setMapping('Location', new Vector("33", 3));

        $movingCommand = new MoveCommand($movingObj);
        $this->expectException(Throwable::class);

        $movingCommand->execute();
    }

    /**
     * Поворот реализован в виде отдельного класса
     * @return void
     */
    public function test_hw2_5_rotate()
    {
        $starShip  = new UObject();
        $rotateObj = new RotatableAdapter($starShip);
        $rotateObj->setDirection(90);

        $rotateCommand = new RotateCommand($rotateObj);
        $rotateCommand->execute();

        $this->assertEquals(
            90.0,
            $starShip->getMapping('Direction'));
    }
}