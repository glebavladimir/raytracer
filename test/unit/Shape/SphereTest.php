<?php

namespace Test\Unit\Shape;

use App\Shape\Ray;
use App\Shape\Sphere;
use App\Vector\Direction;
use App\Vector\Point;
use PHPUnit\Framework\TestCase;

class SphereTest extends TestCase
{

    public function testIntersects()
    {
        $sphere = new Sphere(
            new Point(3, 3, 120),
            3
        );
        $ray1 = new Ray(new Point(0, 0, 0), new Direction(0, 0, 1));
        $ray2 = new Ray(new Point(3, 3, 0), new Direction(0, 0, 1));

        self::assertFalse($sphere->intersects($ray1));
        self::assertTrue($sphere->intersects($ray2));
    }
}
