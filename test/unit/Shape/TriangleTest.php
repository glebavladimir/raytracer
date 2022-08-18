<?php

namespace Test\Unit\Shape;

use App\Shape\Light;
use App\Shape\Ray;
use App\Shape\Sphere;
use App\Shape\Triangle;
use App\Vector\Direction;
use App\Vector\Point;
use Exception;
use PHPUnit\Framework\TestCase;

class TriangleTest extends TestCase
{

    public function testIntersects()
    {
        $triangle = new Triangle(
            new Point(0, 0, 10),
            new Point(18, 0, 10),
            new Point(9, 20, 10),
        );
        $rayDirection = new Direction(0, 0, 1);

        self::assertFalse($triangle->intersects(new Ray(new Point(0, 20, 0), $rayDirection)));
        self::assertTrue($triangle->intersects(new Ray(new Point(3, 3, 0), $rayDirection)));

        $triangle = new Triangle(
            new Point(0, 0, 10),
            new Point(0, 0, 10),
            new Point(0, 0, 10),
        );
        self::assertFalse($triangle->intersects(new Ray(new Point(0, 20, 0), $rayDirection)));

        $triangle = new Triangle(
            new Point(0, 0, -10),
            new Point(18, 0, -10),
            new Point(9, 20, -10),
        );
        self::assertFalse($triangle->intersects(new Ray(new Point(3, 3, 0), $rayDirection)));
    }



    public function testReflectionCoefficient()
    {
        $triangle = new Triangle(
            new Point(0, 10, 130),
            new Point(28, 10, 130),
            new Point(20, 18, 130),
        );
        $light = new Light(new Point(15, 0, 0), 1);

        $triangle->intersects(new Ray(new Point(26, 12, 0), new Direction(0, 0, 1)));
        self::assertEqualsWithDelta(1, $triangle->getReflectionCoefficient($light), 0.1);

        $triangle->intersects(new Ray(new Point(0, 0, 0), new Direction(0, 0, 1)));
        self::assertEquals(-1, $triangle->getReflectionCoefficient($light));
    }

    public function testGetLastReflectionRayLengthException()
    {
        $this->expectException(Exception::class);
        $triangle = new Triangle(
            new Point(0, 10, 130),
            new Point(28, 10, 130),
            new Point(20, 18, 130),
        );
        $triangle->getLastReflectionRayLength();
    }
}
