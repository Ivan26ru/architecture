<?php

use App\HomeworkTwo\Vector;
use App\hw2\Adapter\MovingObjectAdapter;
use App\hw2\commands\MoveCommand;
use App\hw2\UObject;
use PHPUnit\Framework\TestCase;

class hw2Test extends TestCase
{


    /**
     * Для объекта, находящегося в точке (12, 5) и движущегося со скоростью (-7, 3) движение меняет положение объекта на (5, 8)
     * @return void
     */
    public function test_hw2()
    {
        $starShip  = new UObject();
        $movingObj = new MovingObjectAdapter($starShip);

        $starShip->setMapping('Location', new Vector(12, 5));
        $starShip->setMapping('Velocity', new Vector(-7, 3));

        $movingCommand = new MoveCommand($movingObj);
        $movingCommand->execute();

        $this->assertEquals(
            (new Vector(5, 8)),
            $starShip->getMapping('Location'),
            'Тест не прошел: для объекта, находящегося в точке (12, 5) и движущегося со скоростью (-7, 3)
     * движение меняет положение объекта на (5, 8);');

    }
}