<?php /** @noinspection PhpUnhandledExceptionInspection */

use App\Command\Option;
use App\Command\Parser as CommandParser;
use App\Render\Image\Ppm\OutputService as PpmImageOutputService;
use App\Render\Parameters;
use App\Render\Image\Ppm\Renderer;
use App\Shape\Light;
use App\Vector\Point;

require_once '../vendor/autoload.php';

$start_time = microtime(true);

$commandParser = new CommandParser();
$path = $commandParser->getOption(Option::source);
$outputPath = $commandParser->getOption(Option::output);

$side = 200;

if ($path !== null) {
    $loader = new App\Loader\ObjFile($path, $side, $side);
    $renderer = new Renderer(
        new Parameters($side, $side),
        $loader->loadShapeCollection(),
        new Light(new Point(15, 0, -50), 1),
        new PpmImageOutputService($outputPath, $side, $side),
    );
    $renderer->render();
}

echo "- Rendering time = " . (microtime(true) - $start_time) . " sec";
