<?php

namespace App\Render\Inline;

use App\Render\Parameters;
use App\Render\Renderer as CommonRenderer;
use App\Render\RendererInterface;
use App\Shape\ShapeCollection;
use App\Shape\Light;
use Exception;

class Renderer implements RendererInterface
{
    public function __construct(
        private Parameters      $parameters,
        private ShapeCollection $items,
        private Light           $light,
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
        $this->show(
            $renderer->getRows()
        );
    }

    private function show(array $rows)
    {
        echo PHP_EOL;
        foreach ($rows as $row) {
            foreach ($row->pixels as $pixel) {
                echo $pixel->lighting;
            }
            echo PHP_EOL;
        }
    }
}
