<?php
use App\Homework1\Discriminant;

require_once "../vendor/autoload.php";

$a = 10000000;
$b = 0.1**10000000000;
$c = sqrt(-1);

$desc = new Discriminant($a, $b, $c);
$result = $desc->calculate();
echo "<pre>";
var_dump($result);
