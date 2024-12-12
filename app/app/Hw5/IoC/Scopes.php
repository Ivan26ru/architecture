<?php

declare(strict_types=1);

namespace App\Hw5\IoC;

use Exception;

class Scopes implements ScopesInterface
{
    /** @var Scope[] */
    private array $scopes = [];

    private string $currentScopeName = 'default';

    public function createScope(string $scopeName): void
    {
        $this->scopes[$scopeName] = new Scope($scopeName);
    }

    /**
     * @return Scope
     */
    public function getCurrentScope(): Scope
    {
        if (!isset($this->scopes[$this->currentScopeName])) {
            $this->createScope($this->currentScopeName);
        }

        return $this->scopes[$this->currentScopeName];
    }

    public function setCurrentScope(string $scopeName): void
    {
        if (!isset($this->scopes[$scopeName])) {
            throw new Exception("Scope с именем $scopeName не существует.");
        }

        $this->currentScopeName = $scopeName;
    }
}