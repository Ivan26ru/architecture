<?php

namespace Tests\Unit;

use App\Homework1\Discriminant;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DiscriminantTest extends TestCase
{
    private Discriminant $Discriminant;

    /**
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
            [4, 1, 1, 0],//D<0
            [0, 2, 2, 0],//D=0
            [1, 3, 1, 2],//D>0
        ];
    }

    /**
     * @dataProvider dataDescriminantNotIsNan
     */
//    public function testDescriminantNotIsNan($a, $b, $c)
//    {
//        $this->Discriminant = new Discriminant($a, $b, $c);
//        $this->expectException(\Exception::class);
//        $this->Discriminant->calculate();
//    }

    public function dataDescriminantNotIsNan(): array
    {
        return [
//            [sqrt(-1), 1, 1],
//            [1, sqrt(-1), 1],
//            [1, 1, sqrt(-1)],
//            [1, 10000000, 1],
//            [1, 9 ** 9, 1]
        ];
    }


}
