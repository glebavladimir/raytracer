<?php

namespace App\Shape;

use App\Vector\Point;
use App\Vector\Vector3;

interface Intersectable
{
    public function intersects(Ray $ray): bool;

    public function getLastReflectionPoint(): Point;

    public function getPointNormal(Point $pi): Vector3;

    public function getReflectionCoefficient(Light $light): float|int;

    public function getLastReflectionRayLength(): float|int;
}