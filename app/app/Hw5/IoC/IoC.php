<?php

declare(strict_types=1);

namespace App\Hw5\IoC;

use Exception;

class IoC implements IoCInterface
{
    /** @var string Регистрация зависимости в контейнере */
    public const IOC_REGISTER = 'IoC.Register';

    /** @var string Создание скоупа */
    public const SCOPES_NEW = 'Scopes.New';

    /** @var string Переключение на скоуп */
    public const SCOPES_CURRENT = 'Scopes.Current';

    private ?Scopes $scopes = null;

    /**
     * Универсальный метод для регистрации/получения зависимости и создание/переключения на scopes.
     *
     * @param  string  $key
     * @param        ...$args
     *
     * @return mixed
     * @throws Exception
     */
    public function resolve(string $key, ...$args): mixed
    {
        switch ($key) {
            case self::IOC_REGISTER:
                $this->getScopes()->getCurrentScope()->addDependency($args[0], $args[1]);
                break;
            case self::SCOPES_NEW:
                $this->getScopes()->createScope($args[0]);
                break;
            case self::SCOPES_CURRENT:
                $this->getScopes()->setCurrentScope($args[0]);
                break;
            default:
                // Получить у текущего скоупа указанную в $key зависимость
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