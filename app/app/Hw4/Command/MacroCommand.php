<?php
declare(strict_types=1);

namespace App\Hw4\Command;

use App\Hw2\Commands\Interfaces\CommandInterface;

final readonly class MacroCommand implements CommandInterface
{
    /**
     * @param  CommandInterface[]  $macroCommands
     */
    public function __construct(private array $macroCommands) {}

    public function execute(): void
    {
        foreach ($this->macroCommands as $macroCommand) {
            $macroCommand->execute();
        }
    }
}