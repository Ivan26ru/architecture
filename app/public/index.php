<?php

use App\hw2\Adapter\MovingObjectAdapter;
use App\hw2\Adapter\RotatableAdapter;
use App\hw2\Commands\MoveCommand;
use App\hw2\Commands\RotateCommand;
use App\hw2\Commands\Vector;
use App\hw2\UObject;

require_once "../vendor/autoload.php";

try {
    $starShip  = new UObject();
    $movingObj = new MovingObjectAdapter($starShip);

//    $movingObj->setLocation(new Vector(12, 5));
//    $movingObj->setVelocity(new Vector(-7, -10));

//    $movingCommand = new MoveCommand($movingObj);
//    $movingCommand->execute();

    $rotateObj = new RotatableAdapter($starShip);
    $rotateObj->setDirection(360);


    $rotateCommand = new RotateCommand($rotateObj);
    $rotateCommand->execute();


    dump($rotateObj->getDirection());
    dump($starShip);
} catch (Throwable $e) {
    dd($e);
}
