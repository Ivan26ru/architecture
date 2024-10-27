<?php

use App\hw2\commands\MoveCommand;
use App\hw2\commands\MovingObjectAdapter;
use App\hw2\commands\Vector;
use App\hw2\UObject;

require_once "../vendor/autoload.php";

try {
    $object = new UObject();

    dump($object);

    $movingObj = new MovingObjectAdapter($object);
    dump($object);

    $object->setMapping('Velocity', new Vector(3, 4));

    $movingCommand = new MoveCommand($movingObj);
    $movingCommand->execute();
    dump($object);

    $movingCommand->execute();

    dump($object);

} catch (Throwable $e) {
    dd($e);
}
