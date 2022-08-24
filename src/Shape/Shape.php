<?php

namespace App\Shape;

use App\Vector\Point;
use App\Vector\Vector3;
use Exception;

abstract class Shape
{
    const EPSILON = 0.0000001;

    protected ?Point $lastReflectionPoint;
    protected float|int|null $lastReflectionRayLength;

    abstract public function intersects(Ray $ray, bool $sideEffects): bool;

    abstract public function getPointNormal(Point $pi): Vector3;

    public function getReflectionCoefficient(Light $light): float|int
    {
        try {
            $l = $light->center->sub($this->getLastReflectionPoint());
            $n = $this->getPointNormal($this->getLastReflectionPoint());

            return $l->normalize()->dot($n->normalize());
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

    protected function resetIntersection()
    {
        $this->setIntersectionValues(null, null);
    }

    protected function setIntersectionValues(float|int|null $reflectionRayLength, ?Point $reflectionPoint)
    {
        $this->lastReflectionRayLength = $reflectionRayLength;
        $this->lastReflectionPoint = $reflectionPoint;
    }
}