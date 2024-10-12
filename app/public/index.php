<?php

use App\Homework1\Descriminant;

require_once "../vendor/autoload.php";

$a = 1;
$b = 223;

$desc = new Descriminant();

var_dump($desc->calculate(2, 3, 4));
$c = $a + $b;
echo date('r');
echo '<hr>'.$c;
