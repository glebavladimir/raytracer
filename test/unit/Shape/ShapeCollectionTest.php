<?php

namespace Test\Unit\Shape;

use App\Shape\ShapeCollection;
use App\Shape\Ray;
use App\Shape\Sphere;
use App\Shape\Triangle;
use App\Vector\Direction;
use App\Vector\Point;
use PHPUnit\Framework\TestCase;

class ShapeCollectionTest extends TestCase
{

    public function testGetClosestIntersected()
    {
        $items = new ShapeCollection([
            new Sphere(new Point(10, 10, 80), 10),
            new Triangle(
                new Point(0, 10, 130),
                new Point(28, 10, 130),
                new Point(20, 18, 130),
            )
        ]);

        self::assertNull($items->getClosestIntersected(new Ray(
            new Point(0, 0, 0),
            new Direction(0, 0, 1)
        )));

        self::assertInstanceOf(Sphere::class, $items->getClosestIntersected(new Ray(
            new Point(10, 5, 0),
            new Direction(0, 0, 1)
        )));

        self::assertInstanceOf(Triangle::class, $items->getClosestIntersected(new Ray(
            new Point(26, 12, 0),
            new Direction(0, 0, 1)
        )));

        self::assertInstanceOf(Sphere::class, $items->getClosestIntersected(new Ray(
            new Point(16, 12, 0),
            new Direction(0, 0, 1)
        )));
    }
}
