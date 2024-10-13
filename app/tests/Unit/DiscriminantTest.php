<?php

namespace Tests\Unit;

use App\Homework1\Discriminant;
use PHPUnit\Framework\TestCase;

class DiscriminantTest extends TestCase
{
    private Discriminant $Discriminant;

    /** Проверка верного расчета дискриминанта
     * @dataProvider dataDiscriminantCount
     */
    public function testDiscriminantCount($a, $b, $c, $expected)
    {
        $this->Discriminant = new Discriminant($a, $b, $c);
        $result             = $this->Discriminant->calculate();
        $this->assertEquals(count($result), $expected);
    }

    public function dataDiscriminantCount(): array
    {
        return [
            'D < 0' => [4+(0.1**13), 1, 1, 0],
            'D = 0' => [1, 2+(0.1**13), 1, 1],
            'D > 0' => [1, 3, 1+(0.1**13), 2],
        ];
    }

    /**
     * Проверка исключений
     * @dataProvider dataDescriminantNotIsNan
     */
    public function testDescriminantNotIsNan($a, $b, $c)
    {
        $this->expectException(\Exception::class);
        $this->Discriminant = new Discriminant($a, $b, $c);
        $this->Discriminant->calculate();
    }

    public function dataDescriminantNotIsNan(): array
    {
        return [
            'Exception A не может быть 0'=>[0, 1, 1],
            'Exception бесконечный A'=>[sqrt(-1), 1, 1],
            'Exception бесконечный B'=>[1, sqrt(-1), 1],
            'Exception бесконечный C'=>[1, 1, sqrt(-1)],
            'Exception B много больше A'=>[1, 10000000, 1],
            'Exception D = INFINITE'=>[1, 9 ** 9, 1]
        ];
    }

    /**
     * @dataProvider dataTestCalculate
     */
    public function testCalculate($a, $b, $c, $expected){
        $this->Discriminant = new Discriminant($a, $b, $c);
        $result = $this->Discriminant->calculate();
        $this->assertEquals($result, $expected);
    }

    public static function dataTestCalculate()
    {
        return [
            'нет корней ' =>[1,1,1,[]],
            'один корень ' => [1, 2, 1, [-1]],
            'два корня' =>[1,3,1,[-0.3819660112501051,-2.618033988749895]]
        ];
    }
}
