<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace Test\Unit\Utils;

use App\Utils\Math;
use App\Utils\SquareRootSolveException;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{

    public function testGetDiscriminant()
    {
        self::assertEquals(1, Math::getDiscriminant(1, 1, 0));
        self::assertEquals(-4, Math::getDiscriminant(1, 0, 1));
        self::assertEquals(1, Math::getDiscriminant(0, 1, 1));
        self::assertEquals(-8, Math::getDiscriminant(1, 2, 3));
        self::assertEquals(-8, Math::getDiscriminant(3, 2, 1));
    }

    public function testSolveSquareRootEquation()
    {
        self::assertEquals([0, -1], Math::solveSquareRootEquation(1, 1, 0));
    }

    public function testSolveSquareRootEquationDivisionByZero()
    {
        $this->expectException(SquareRootSolveException::class);
        Math::solveSquareRootEquation(0, 1, 1);
    }

    public function testSolveSquareRootEquationNegativeDiscriminantException()
    {
        $this->expectException(SquareRootSolveException::class);
        Math::solveSquareRootEquation(3, 2, 1);
    }


}
