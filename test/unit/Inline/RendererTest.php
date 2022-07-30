<?php

namespace Test\Unit\Inline;

use App\Inline\Pixel;
use App\Inline\Renderer;
use App\Inline\Row;
use PHPUnit\Framework\TestCase;

class RendererTest extends TestCase
{
    public function testRenderOutput()
    {
        $renderer = new Renderer();
        $renderer->addRow(new Row([
            Pixel::fromProduct(-1),
            Pixel::fromProduct(.7),
            Pixel::fromProduct(1.7),
            Pixel::fromProduct(.7),
            Pixel::fromProduct(-3.9),
        ]));
        $renderer->addRow(new Row([
            Pixel::fromProduct(-1),
            Pixel::fromProduct(1.7),
            Pixel::fromProduct(1.7),
            Pixel::fromProduct(.7),
            Pixel::fromProduct(-3.9),
        ]));

        ob_start();
        $renderer->show();
        $output = ob_get_clean();

        $expectedOutput = "\n 0#0 \n ##0 \n";

        self::assertEquals($expectedOutput, $output);
    }
}
