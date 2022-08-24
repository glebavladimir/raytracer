<?php

namespace App\Shape;

use App\Utils\Math;
use App\Vector\Point;
use App\Vector\Vector3;
use Exception;

class Sphere extends Shape
{
    public function __construct(
        public Point $center,
        public float $radius,
    ) {}

    /**
     * @throws Exception
     */
    public function intersects(Ray $ray, bool $sideEffects = true): bool
    {
        if ($sideEffects) {
            $this->resetIntersection();
        }

        $distanceToCenter = $ray->point->sub($this->center);
        $a = $ray->direction->dot($ray->direction);
        $b = 2 * $distanceToCenter->dot($ray->direction);
        $c = $distanceToCenter->dot($distanceToCenter) - $this->radius * $this->radius;

        $discriminant = Math::getDiscriminant($a, $b, $c);

        $intersects = $discriminant > 0;
        if (!$sideEffects) {
            return $intersects;
        }
        if ($intersects) {
            list($x1, $x2) = Math::solveSquareRootEquation($a, $b, $c, $discriminant);
            $t = min($x1, $x2);
            $this->setIntersectionValues($t, $ray->point->add($ray->direction->mul($t)));
        }

        return $intersects;
    }

    public function getPointNormal(Point $pi): Vector3
    {
        return $pi->sub($this->center)->normalize();
    }
}