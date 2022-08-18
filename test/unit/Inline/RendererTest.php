<?php

namespace Test\Unit\Inline;

use App\Inline\Parameters;
use App\Inline\Renderer;
use App\Shape\Light;
use App\Shape\ShapeCollection;
use App\Shape\Sphere;
use App\Vector\Point;
use PHPUnit\Framework\TestCase;

class RendererTest extends TestCase
{
    public function testRenderOutput()
    {
        $renderer = new Renderer(
            new Parameters(5, 5),
            new ShapeCollection([
                new Sphere(new Point(3, 3, 3), 2)
            ]),
            new Light(new Point(0, 0, 0), 1)
        );

        ob_start();
        $renderer->render();
        $output = ob_get_clean();

        $expectedOutput = "\n     \n     \n  #0.\n  0*.\n  ..*\n";

        self::assertEquals($expectedOutput, $output);
    }
}
