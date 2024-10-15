<?php

namespace App\Homework1;

class Discriminant
{
    private $a;
    private $b;
    private $c;
    private $epsilon = 0.1 ** 12;

    public function __construct(
        float $a,
        float $b,
        float $c
    ) {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;

        if ($this->a == 0) {
            throw new \Exception('A не может быть 0');
        }
    }

    /**
     * Расчет дискриминанта
     * @throws \Exception
     */
    public function calculate(): array
    {
        $d = $this->getDiscriminant();

        if ($d < -$this->epsilon) { // D<0
            $result = [];
        } elseif (abs($d) <= $this->epsilon) { // D=0
            $result = $this->getX1();
        } elseif ($d > $this->epsilon) {
            $result = $this->getX1X2(d: $d);
        }

        return $result;
    }

    private function getDiscriminant(): float
    {
        $maxManyMore = 10 ** 6;
        if ($this->b / $this->a > $maxManyMore) {
            throw new \Exception('B много больше A');
        }

        $d = $this->b * $this->b - 4 * $this->a * $this->c;
        if (is_nan($d)) {
            throw new \Exception('D = NAN');
        }

        if (is_infinite($d)) {
            throw new \Exception('D = INFINITE');
        }

        return $d;
    }

    private function getX1(): array
    {
        $x1 = -$this->b / 2 * $this->a;
        return [$x1];
    }

    private function getX1X2($d): array
    {
        $x1 = (-$this->b + sqrt($d)) / (2 * $this->a);
        $x2 = (-$this->b - sqrt($d)) / (2 * $this->a);
        return [$x1, $x2];
    }
}
