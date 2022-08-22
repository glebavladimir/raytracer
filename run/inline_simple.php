<?php

use App\Render\Inline\Parameters;
use App\Render\Inline\Renderer;
use App\Shape\ShapeCollection;
use App\Shape\Light;
use App\Shape\Sphere;
use App\Shape\Triangle;
use App\Vector\Point;

require_once '../vendor/autoload.php';

$renderer = new Renderer(
    new Parameters(30, 20),
    new ShapeCollection([
        new Sphere(new Point(10, 10, 80), 10),
        new Triangle(
            new Point(0, 10, 130),
            new Point(28, 10, 130),
            new Point(20, 18, 130),
        )
    ]),
    new Light(new Point(15, 0, 0), 1)
);
$renderer->render();
