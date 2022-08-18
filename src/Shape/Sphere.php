<?php

namespace App\Shape;

use App\Utils\Math;
use App\Vector\Point;
use App\Vector\Vector3;
use Exception;

class Sphere implements Intersectable
{
    private ?Point $lastReflectionPoint;
    private float|int|null $lastReflectionRayLength;

    public function __construct(
        public Point $center,
        public float $radius,
    ) {}

    /**
     * @throws Exception
     */
    public function intersects(Ray $ray): bool
    {
        $this->resetIntersection();

        $distanceToCenter = $ray->point->sub($this->center);
        $a = $ray->direction->dot($ray->direction);
        $b = 2 * $distanceToCenter->dot($ray->direction);
        $c = $distanceToCenter->dot($distanceToCenter) - $this->radius * $this->radius;

        $discriminant = Math::getDiscriminant($a, $b, $c);

        $intersects = $discriminant > 0;
        if ($intersects) {
            list($x1, $x2) = Math::solveSquareRootEquation($a, $b, $c, $discriminant);
            $t = min($x1, $x2);
            $this->lastReflectionRayLength = $t;
            $this->lastReflectionPoint = $ray->point->add($ray->direction->mul($t));
        }

        return $intersects;
    }


    public function getReflectionCoefficient(Light $light): float|int
    {
        try {
            $l = $light->center->sub($this->getLastReflectionPoint());
            $n = $this->getPointNormal($this->getLastReflectionPoint());
            return abs($l->normalize()->dot($n->normalize()));
        } catch (Exception) {
            return -1;
        }
    }

    /**
     * @return Point
     * @throws Exception
     */
    public function getLastReflectionPoint(): Point
    {
        if (!isset($this->lastReflectionPoint)) {
            throw new Exception("Reflection point is not saved: try to check intersection before");
        }
        return $this->lastReflectionPoint;
    }

    public function getPointNormal(Point $pi): Vector3
    {
        return $pi->sub($this->center)->normalize();
    }

    /**
     * @throws Exception
     */
    public function getLastReflectionRayLength(): float|int
    {
        if (!isset($this->lastReflectionRayLength)) {
            throw new Exception("Reflection point length is not saved: try to check intersection before");
        }
        return $this->lastReflectionRayLength;
    }

    private function resetIntersection()
    {
        $this->lastReflectionRayLength = null;
        $this->lastReflectionPoint = null;
    }
}