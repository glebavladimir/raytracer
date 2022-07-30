<?php

namespace App\Shape;

interface Intersectable
{
    public function intersects(Ray $ray): bool;
}