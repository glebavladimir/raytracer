<?php

use App\Inline\Pixel;
use App\Inline\Renderer;
use App\Inline\Row;
use App\Shape\IntersectableCollection;
use App\Shape\Light;
use App\Shape\Ray;
use App\Shape\Sphere;
use App\Shape\Triangle;
use App\Vector\Direction;
use App\Vector\Point;

require_once '../vendor/autoload.php';


$renderer = new Renderer(30, 20);

$items = new IntersectableCollection([
    new Sphere(new Point(10, 10, 80), 10),
    new Triangle(
        new Point(0, 10, 130),
        new Point(28, 10, 130),
        new Point(20, 18, 130),
    )
]);

$light = new Light(new Point(15, 0, 0), 1);

for ($y = 0; $y < $renderer->height; $y++) {
    $row = new Row();
    for ($x = 0; $x < $renderer->width; $x++) {
        $ray = new Ray(
            new Point($x, $y, 0),
            new Direction(0, 0, 1)
        );
        $intersectable = $items->getClosestIntersected($ray);
        if ($intersectable !== null) {
            $row->addPixel(Pixel::fromCoefficient($intersectable->getReflectionCoefficient($light)));
        } else {
            $row->addPixel(new Pixel(Pixel::EMPTY));
        }
    }
    $renderer->addRow($row);
}

$renderer->show();