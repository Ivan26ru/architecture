<?php

namespace App\Hw2;

class UObject
{
    public array $mapping;

    public function __construct()
    {
        $this->setMapping(
            'Angle', 0
        );
    }

    public function getMapping(string|int $key)
    {
        // @todo обработать в случае ошибки
        return $this->mapping[$key];
    }

    public function setMapping(string|int $key, $value = null): void
    {
        $this->mapping[$key] = $value;
    }

}