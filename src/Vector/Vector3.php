<?php

namespace App\Vector;

abstract class Vector3
{
    public function __construct(
        public float $x = 0,
        public float $y = 0,
        public float $z = 0,
    ) {}

    public function add(Vector3 $vector): Vector3
    {
        $this->x += $vector->x;
        $this->y += $vector->y;
        $this->z += $vector->z;

        return $this;
    }

    public function sub(Vector3 $vector): Vector3
    {
        $this->x -= $vector->x;
        $this->y -= $vector->y;
        $this->z -= $vector->z;

        return $this;
    }

    public function dot(Vector3 $vector): float|int
    {
        return
        $this->x * $vector->x +
        $this->y * $vector->y +
        $this->z * $vector->z;
    }

    public function mul(float|int $a): Vector3
    {
        $this->x *= $a;
        $this->y *= $a;
        $this->z *= $a;

        return $this;
    }

    public function div(float|int $a): Vector3
    {
        $this->x /= $a;
        $this->y /= $a;
        $this->z /= $a;

        return $this;
    }
}