<?php

use App\hw2\Adapter\MovingObjectAdapter;
use App\hw2\commands\MoveCommand;
use App\hw2\commands\Vector;
use App\hw2\UObject;

require_once "../vendor/autoload.php";

try {
    $ship = new UObject();

    $location1 = new Vector(12, 5);
    $speed     = new Vector(-7, 3);

    dump(Vector::add($location1, $speed));

} catch (Throwable $e) {
    dd($e);
}
