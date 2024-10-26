<?php

use App\hw2\commands\MoveCommand;
use App\hw2\commands\MovingObjectAdapter;
use App\hw2\UObject;

require_once "../vendor/autoload.php";

try {


$object = new UObject();

$movingObj = new MovingObjectAdapter($object);

$object2 = (new MoveCommand())->move($movingObj)->Execute();

dd($object, $movingObj, $object2);

//$vectorThis = new Vector([0, 0]);
//
//dd(Vector::add($vectorThis, new Vector([2, 3])));
} catch (Throwable $e) {
    dd($e);
    echo $e->getMessage();
    die();
}
