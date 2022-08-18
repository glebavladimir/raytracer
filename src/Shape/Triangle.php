<?php

namespace App\Shape;

use App\Vector\Point;
use App\Vector\Vector3;

class Triangle extends Shape
{
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
        if ($t > self::EPSILON)
        {
            $this->setIntersectionValues($t, $ray->point->add($ray->direction->mul($t)));
            return true;
        }

        return false;
    }

    public function getPointNormal(Point $pi): Vector3
    {
        $edge1 = $this->bVertex->sub($this->aVertex);
        $edge2 = $this->cVertex->sub($this->aVertex);

        return $edge1->cross($edge2)->normalize();
    }
}