<?php

namespace App\hw2;

class UObject
{
    public array $mapping;

    public function __construct()
    {
        $this->setMapping(
            'Location', [0, 0]
        );
        $this->setMapping(
            'Angle', 0
        );
        $this->setMapping(
            'Velocity', [2, 3]
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