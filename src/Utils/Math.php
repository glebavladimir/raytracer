<?php

namespace App\Utils;

class Math
{
    public static function getDiscriminant(int|float $a, int|float $b, int|float $c): float|int
    {
        return $b * $b - 4 * $a * $c;
    }
}