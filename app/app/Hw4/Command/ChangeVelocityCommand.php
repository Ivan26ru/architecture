<?php
declare(strict_types=1);

namespace App\Hw4\Command;

use App\Hw2\Commands\Interfaces\CommandInterface;
use App\Hw2\Commands\Vector;
use App\Hw4\Adapter\Interfaces\VelocityChangeableInterface;
use App\Hw4\Exception\CommandException;

final readonly class ChangeVelocityCommand implements CommandInterface
{
    public function __construct(private VelocityChangeableInterface $velocityChangeable, private Vector $newVelocity) {}


    /**
     * @throws CommandException
     */
    public function execute(): void
    {
        $currentVelocity = $this->velocityChangeable->getVelocity();

        if (null === $currentVelocity) {
            throw new CommandException('Данный объект не может двигаться.');
        }

        $this->velocityChangeable->setVelocity($this->newVelocity);
    }
}