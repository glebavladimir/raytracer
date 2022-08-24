<?php

namespace App\Render\Image\Ppm;

use App\Render\Parameters;
use App\Render\Renderer as CommonRenderer;
use App\Render\RendererInterface;
use App\Shape\Light;
use App\Shape\ShapeCollection;
use Exception;

class Renderer implements RendererInterface
{
    public function __construct(
        private Parameters      $parameters,
        private ShapeCollection $items,
        private Light           $light,
        private OutputService $outputService,
    )
    {
    }

    /**
     * @throws Exception
     */
    public function render(): void
    {
        $renderer = new CommonRenderer(
            $this->parameters,
            $this->items,
            $this->light,
            new PixelFactory(),
        );

        $this->outputService->output(
            $renderer->getRows()
        );
    }
}