<?php

namespace Test\Unit\Inline;

use App\Inline\Pixel;
use App\Inline\Row;
use PHPUnit\Framework\TestCase;

class RowTest extends TestCase
{

    public function testAddPixel()
    {
        $row = new Row();
        $pixel = new Pixel(Pixel::BRIGHT);
        $row->addPixel($pixel);
        $row->addPixel($pixel);
        $row->addPixel($pixel);

        self::assertEquals(
            new Row([$pixel, $pixel, $pixel]),
            $row
        );
    }
}
