<?php

use App\Inline\Pixel;
use App\Inline\Renderer;
use App\Inline\Row;
use App\Shape\Ray;
use App\Shape\Sphere;
use App\Vector\Direction;
use App\Vector\Point;

require_once '../vendor/autoload.php';

$sphere = new Sphere(
    new Point(10, 10, 120),
    10
);

$renderer = new Renderer(20, 20);

for ($y = 0; $y < $renderer->height; $y++) {
    $row = new Row();
    for ($x = 0; $x < $renderer->width; $x++) {
        $ray = new Ray(new Point($x, $y, 0), new Direction(0, 0, 1));
        if ($sphere->intersects($ray)) {
            $row->addPixel(new Pixel(Pixel::BRIGHT));
        } else {
            $row->addPixel(new Pixel(Pixel::EMPTY));
        }
    }
    $renderer->addRow($row);
}

$renderer->show();
