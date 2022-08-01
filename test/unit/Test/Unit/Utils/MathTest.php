<?php

namespace Test\Unit\Utils;

use App\Utils\Math;
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
}
