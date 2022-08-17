<?php

namespace App\Vector;

abstract class Vector3
{
    public function __construct(
        public float $x = 0,
        public float $y = 0,
        public float $z = 0,
    )
    {
    }

    public function add(Vector3 $vector): static
    {
        return new static(
            $this->x + $vector->x,
            $this->y + $vector->y,
            $this->z + $vector->z,
        );
    }

    public function sub(Vector3 $vector): static
    {
        return new static(
            $this->x - $vector->x,
            $this->y - $vector->y,
            $this->z - $vector->z,
        );
    }

    public function dot(Vector3 $vector): float|int
    {
        return
            $this->x * $vector->x +
            $this->y * $vector->y +
            $this->z * $vector->z;
    }

    public function mul(float|int $a): static
    {
        return new static(
            $this->x * $a,
            $this->y * $a,
            $this->z * $a,
        );
    }

    public function div(float|int $a): static
    {
        return new static(
            $this->x / $a,
            $this->y / $a,
            $this->z / $a,
        );
    }

    public function cross(Vector3 $vector): static
    {
        return new static(
            $this->y * $vector->z - $this->z * $vector->y,
            $this->z * $vector->x - $this->x * $vector->z,
            $this->x * $vector->y - $this->y * $vector->x,
        );
    }
}