<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace Test\Unit\Shape;

use App\Shape\Light;
use App\Shape\Ray;
use App\Shape\Sphere;
use App\Vector\Direction;
use App\Vector\Point;
use Exception;
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

    public function testReflectionCoefficientOutOfObject()
    {
        $sphere = new Sphere(new Point(10, 10, 80), 10);
        $light = new Light(new Point(15, 0, 0), 1);

        self::assertEquals(-1, $sphere->getReflectionCoefficient($light));
    }

    public function testReflectionCoefficient()
    {
        $sphere = new Sphere(new Point(10, 10, 80), 10);
        $light = new Light(new Point(15, 0, 0), 1);

        $sphere->intersects(new Ray(new Point(10, 10, 0), new Direction(0, 0, 1)));
        self::assertEqualsWithDelta(1, $sphere->getReflectionCoefficient($light), 0.1);

        $sphere->intersects(new Ray(new Point(7, 1, 0), new Direction(0, 0, 1)));
        self::assertEqualsWithDelta(0.3, $sphere->getReflectionCoefficient($light), 0.1);

        $sphere->intersects(new Ray(new Point(0, 0, 0), new Direction(0, 0, 1)));
        self::assertEquals(-1, $sphere->getReflectionCoefficient($light));
    }

    public function testGetLastReflectionRayLengthException()
    {
        $this->expectException(Exception::class);
        $sphere = new Sphere(new Point(10, 10, 80), 10);
        $sphere->getLastReflectionRayLength();
    }
}
