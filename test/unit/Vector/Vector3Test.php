<?php

namespace Test\Unit\Vector;

use App\Vector\Direction;
use App\Vector\Point;
use PHPUnit\Framework\TestCase;

class Vector3Test extends TestCase
{

    public function testDot()
    {
        $vector1 = new Point(5, 4, 3);
        $vector2 = new Point(5, 5, 5);
        self::assertEquals(60, $vector1->dot($vector2));
    }

    public function testSub()
    {
        $vector1 = new Point(5, 4, 3);
        $vector2 = new Point(5, 5, 5);
        self::assertEquals(new Point(0, -1, -2), $vector1->sub($vector2));
    }

    public function testDiv()
    {
        $vector = new Point(5, 4, 3);
        self::assertEquals(new Point(2.5, 2, 1.5), $vector->div(2));
    }

    public function testAdd()
    {
        $vector1 = new Point(5, 4, 3);
        $vector2 = new Point(5, 5, 5);
        self::assertEquals(new Point(10, 9, 8), $vector1->add($vector2));
    }

    public function testMul()
    {
        $vector = new Point(5, 4, 3);
        self::assertEquals(new Point(10, 8, 6), $vector->mul(2));
    }

    public function testCross()
    {
        $vector1 = new Point(5, 4, 3);
        $vector2 = new Point(5, 5, 5);
        self::assertEquals(new Point(5, -10, 5), $vector1->cross($vector2));
    }

    public function testNormalize()
    {
        $direction = new Direction(0, 0, 234);
        self::assertEquals(new Direction(0, 0, 1), $direction->normalize());

        $direction = new Direction(8, 8, 16);
        self::assertEqualsWithDelta(new Direction(0.4, 0.4, 0.8,), $direction->normalize(), 0.1);
    }
}
