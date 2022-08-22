<?php

use App\Command\Option;
use App\Command\Parser as CommandParser;
use App\Inline\Parameters;
use App\Inline\Renderer;
use App\Shape\Light;
use App\Vector\Point;

require_once '../vendor/autoload.php';

$commandParser = new CommandParser();
$path = $commandParser->getOption(Option::source);

$side = 50;

if ($path !== null) {
    $loader = new App\Loader\ObjFile($path, $side, $side);
    $renderer = new Renderer(
        new Parameters($side, $side),
        $loader->loadShapeCollection(),
        new Light(new Point(15, 0, 0), 1)
    );
    $renderer->render();
}
