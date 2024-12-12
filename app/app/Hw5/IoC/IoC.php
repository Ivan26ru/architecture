<?php

declare(strict_types=1);

namespace App\Hw5\IoC;

use Exception;

class IoC implements IoCInterface
{
    /** @var string Регистрация зависимости в контейнере */
    public const string IOC_REGISTER = 'IoC.Register';

    /** @var string Создание скоупа */
    public const string SCOPES_NEW = 'Scopes.New';

    /** @var string Переключение на скоуп */
    public const string SCOPES_CURRENT = 'Scopes.Current';

    private ?Scopes $scopes = null;

    /**
     * Универсальный метод для регистрации/получения зависимости и создание/переключения на scopes.
     *
     * @param string $key
     * @param        ...$args
     * @return mixed
     * @throws Exception
     */
    public function resolve(string $key, ...$args): mixed
    {
        if (self::IOC_REGISTER === $key) {
            $this->getScopes()->getCurrentScope()->addDependency($args[0], $args[1]);
        } elseif (self::SCOPES_NEW === $key) {
            $this->getScopes()->createScope($args[0]);
        } elseif (self::SCOPES_CURRENT === $key) {
            $this->getScopes()->setCurrentScope($args[0]);
        } else {
            return $this->getScopes()->getCurrentScope()->resolve($key, ...$args);
        }

        return true;
    }

    private function getScopes(): Scopes
    {
        if (null === $this->scopes) {
            $this->scopes = new Scopes();
        }

        return $this->scopes;
    }
}