<?php

namespace App\Shape;

use App\Vector\Direction;
use App\Vector\Point;

class Ray
{
    public function __construct(
        public Point $point,
        public Direction $direction,
    ) {}
}