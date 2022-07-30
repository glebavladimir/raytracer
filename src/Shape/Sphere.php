<?php

namespace App\Shape;

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
        $b = 2 * $distanceToCenter->dot($ray->direction);
        return $b * $b - 4 * ($distanceToCenter->dot($distanceToCenter) - $this->radius * $this->radius);
    }
}