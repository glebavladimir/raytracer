<?php

namespace App\Utils;

use Exception;

class Math
{

    public static function getDiscriminant(int|float $a, int|float $b, int|float $c): float|int
    {
        return $b * $b - 4 * $a * $c;
    }

    /**
     * @throws Exception
     */
    public static function solveSquareRootEquation(int|float $a, int|float $b, int|float $c, int|float $discriminant = null): array
    {
        if ($a === 0) {
            throw new SquareRootSolveException("Cannot solve: 'a' is equal to '0', thus division by zero");
        }

        $discriminant = $discriminant ?? self::getDiscriminant($a, $b, $c);
        if ($discriminant < 0){
            throw new SquareRootSolveException("Negative discriminant: complex solutions not supported");
        }
        return [
            (-$b + sqrt($discriminant))/(2*$a),
            (-$b - sqrt($discriminant))/(2*$a)
        ];
    }
}