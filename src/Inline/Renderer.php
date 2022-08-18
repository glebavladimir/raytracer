<?php

namespace App\Inline;

use App\Shape\ShapeCollection;
use App\Shape\Light;
use App\Shape\Ray;
use App\Vector\Direction;
use App\Vector\Point;

class Renderer
{
    private array $rows = [];

    public function __construct(
        private Parameters $parameters,
        private ShapeCollection $items,
        private Light $light,
    ) {}

    public function render() {
        for ($y = 0; $y < $this->parameters->height; $y++) {
            $row = new Row();
            for ($x = 0; $x < $this->parameters->width; $x++) {
                $ray = new Ray(
                    new Point($x, $y, 0),
                    new Direction(0, 0, 1)
                );
                $intersectable = $this->items->getClosestIntersected($ray);
                if ($intersectable !== null) {
                    $row->addPixel(Pixel::fromCoefficient($intersectable->getReflectionCoefficient($this->light)));
                } else {
                    $row->addPixel(new Pixel(Pixel::EMPTY));
                }
            }
            $this->addRow($row);
        }

        $this->show();
    }

    private function addRow(Row $row): void
    {
        array_push($this->rows, $row);
    }

    private function show()
    {
        echo PHP_EOL;
        foreach ($this->rows as $row) {
            foreach ($row->pixels as $pixel) {
                echo $pixel->lighting;
            }
            echo PHP_EOL;
        }
    }
}
