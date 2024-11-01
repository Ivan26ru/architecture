<?php

use App\Hw2\Adapter\MovingObjectAdapter;
use App\Hw2\Adapter\RotatableAdapter;
use App\Hw2\Commands\MoveCommand;
use App\Hw2\Commands\RotateCommand;
use App\Hw2\Commands\Vector;
use App\Hw2\UObject;
use App\Hw3\Command\QueueCommand;
use App\Hw3\Command\RepeatAgainCommand;
use App\Hw3\Dto\CommandDto;
use App\Hw3\Strategy\StrategyOneException;

require_once "../vendor/autoload.php";

$starShip  = new UObject();
$movingObj = new MovingObjectAdapter($starShip);
$movingObj->setLocation(new Vector(12, 5));
$movingObj->setVelocity(new Vector(-7, 3));

$movingCommand = new MoveCommand($movingObj);

$commandDto = new CommandDto($movingCommand);

QueueCommand::addCommand($commandDto);

$strategyOneException = new StrategyOneException();
$queueCommand         = new QueueCommand($strategyOneException);
$queueCommand->execute();

$commandRepeat = RepeatAgainCommand::getRepeatedCommands();

dump($commandRepeat);
dump($starShip);

dump(\App\Hw3\Command\LogCommand::getLogs());
