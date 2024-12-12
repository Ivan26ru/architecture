<?php

declare(strict_types=1);

namespace App\Hw5\IoC;

/**
 * IoC интерфейс.
 */
interface IoCInterface
{
    /**
     * Универсальный метод для регистрации/получения зависимости и создание/переключения на scopes.
     *
     * @param  string  $key
     * @param        ...$args
     *
     * @return mixed
     */
    public function resolve(string $key, ...$args): mixed;
}