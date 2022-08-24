<?php

namespace App\Render;

use App\Shape\Light;
use App\Shape\Ray;
use App\Shape\ShapeCollection;
use App\Vector\Direction;
use App\Vector\Point;
use Exception;

class Renderer
{
    private array $rows = [];

    public function __construct(
        private Parameters            $parameters,
        private ShapeCollection       $items,
        private Light                 $light,
        private PixelFactoryInterface $pixelFactory,
    )
    {
    }

    /**
     * @throws Exception
     */
    public function getRows(): RowCollection
    {
        for ($y = 0; $y < $this->parameters->height; $y++) {
            $row = new Row();
            for ($x = 0; $x < $this->parameters->width; $x++) {
                $ray = new Ray(
                    new Point($x, $y, 0),
                    new Direction(0, 0, 1)
                );
                $intersectable = $this->items->getClosestIntersected($ray);
                if ($intersectable !== null) {
                    $row->addPixel(
                        $this->pixelFactory->fromCoefficient(
                            $intersectable->getReflectionCoefficient($this->light)
                        )
                    );
                } else {
                    $row->addPixel($this->pixelFactory->getEmpty());
                }
            }
            $this->addRow($row);
        }

        return new RowCollection($this->rows);
    }

    private function addRow(Row $row): void
    {
        array_push($this->rows, $row);
    }
}