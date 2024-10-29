<?php

use App\hw2\Adapter\MovingObjectAdapter;
use App\hw2\commands\MoveCommand;
use App\hw2\commands\Vector;
use App\hw2\UObject;

require_once "../vendor/autoload.php";

try {
    $starShip  = new UObject();
    $movingObj = new MovingObjectAdapter($starShip);

    $starShip->setMapping('Location', new Vector(12, 5));
    $starShip->setMapping('Velocity', new Vector(-7, 10));

    $movingCommand = new MoveCommand($movingObj);
    $movingCommand->execute();
    dump($starShip);
} catch (Throwable $e) {
    dd($e);
}
