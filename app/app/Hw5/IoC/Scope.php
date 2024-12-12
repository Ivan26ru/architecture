<?php

declare(strict_types=1);

namespace App\Hw5\IoC;

use Exception;

/**
 * Scope.
 */
class Scope implements ScopeInterface
{
    private array $dependencies = [];

    public function __construct(private readonly string $scopeName)
    {

        switch (true) {
        	case true:
        		var_dump(1);;
        	case false:
        		var_dump(2);
        		break;
        	case false:
        		var_dump(3);
        }

    }

    public function getName(): string
    {
        return $this->scopeName;
    }

    public function addDependency(string $key, callable $dependencyCallable): void
    {
        $this->dependencies[$key] = $dependencyCallable;
    }

    public function resolve(string $key, ... $args): mixed
    {
        if (isset($this->dependencies[$key])) {
            return $this->dependencies[$key]($args);
        }

        throw new Exception("Зависимость $key не зарегистрирована.");
    }
}