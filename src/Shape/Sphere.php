<?php

namespace App\Shape;

use App\Utils\Math;
use App\Vector\Point;

class Sphere implements Intersectable
{
    public function __construct(
        public Point $center,
        public float $radius,
    ) {}

    public function intersects(Ray $ray): bool
    {
        $discriminant = $this->getDiscriminant($ray);

        return $discriminant > 0;
    }

    private function getDiscriminant(Ray $ray): int|float
    {
        $distanceToCenter = $ray->point->sub($this->center);

        return Math::getDiscriminant(
            $ray->direction->dot($ray->direction),
            2 * $distanceToCenter->dot($ray->direction),
            $distanceToCenter->dot($distanceToCenter) - $this->radius * $this->radius
        );
    }
}