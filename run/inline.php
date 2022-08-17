<?php

use App\Inline\Pixel;
use App\Inline\Renderer;
use App\Inline\Row;
use App\Shape\Intersectable;
use App\Shape\Ray;
use App\Shape\Sphere;
use App\Shape\Triangle;
use App\Vector\Direction;
use App\Vector\Point;

require_once '../vendor/autoload.php';

function render(Renderer $renderer, Intersectable $shape)
{
    for ($y = 0; $y < $renderer->height; $y++) {
        $row = new Row();
        for ($x = 0; $x < $renderer->width; $x++) {
            $ray = new Ray(
                new Point($x, $y, 0),
                new Direction(0, 0, 1)
            );
            if ($shape->intersects($ray)) {
                $row->addPixel(new Pixel(Pixel::BRIGHT));
            } else {
                $row->addPixel(new Pixel(Pixel::EMPTY));
            }
        }
        $renderer->addRow($row);
    }

    $renderer->show();
}

render(
    new Renderer(20, 20),
    new Sphere(
        new Point(10, 10, 120),
        10
    )
);

render(
    new Renderer(20, 20),
    new Triangle(
        new Point(0, 0, 10),
        new Point(18, 0, 10),
        new Point(9, 20, 10),
    )
);
