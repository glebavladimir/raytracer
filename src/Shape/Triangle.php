<?php

namespace App\Shape;

use App\Vector\Point;
use App\Vector\Vector3;
use Exception;

class Triangle implements Intersectable
{
    const EPSILON = 0.0000001;

    private ?Point $lastReflectionPoint;
    private float|int|null $lastReflectionRayLength;

    public function __construct(
        private Point $aVertex,
        private Point $bVertex,
        private Point $cVertex,
    ) {}

    public function intersects(Ray $ray): bool
    {
        $this->resetIntersection();
        $edge1 = $this->bVertex->sub($this->aVertex);
        $edge2 = $this->cVertex->sub($this->aVertex);
        $h = $ray->direction->cross($edge2);
        $a = $edge1->dot($h);
        if ($a > -self::EPSILON && $a < self::EPSILON)
            return false;
        $f = 1/$a;
        $s = $ray->point->sub($this->aVertex);
        $u = $f * $s->dot($h);
        if ($u < 0 || $u > 1) {
            return false;
        }
        $q = $s->cross($edge1);
        $v = $f * $ray->direction->dot($q);
        if ($v < 0 || $u + $v > 1)
            return false;

        $t = $f * $edge2->dot($q);
        $this->lastReflectionRayLength = $t;
        if ($t > self::EPSILON)
        {
            $this->lastReflectionPoint = $ray->point->add($ray->direction->mul($t));
            return true;
        }

        return false;
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
        $edge1 = $this->bVertex->sub($this->aVertex);
        $edge2 = $this->cVertex->sub($this->aVertex);

        return $edge1->cross($edge2)->normalize();
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