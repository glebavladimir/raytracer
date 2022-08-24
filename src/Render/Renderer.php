<?php

namespace App\Render;

use App\Shape\Light;
use App\Shape\Ray;
use App\Shape\Shape;
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

                $row->addPixel(
                    $this->calculatePixel(
                        $this->items->getClosestIntersected($ray)
                    )
                );
            }
            $this->addRow($row);
        }

        return new RowCollection($this->rows);
    }

    private function addRow(Row $row): void
    {
        array_push($this->rows, $row);
    }

    /**
     * @throws Exception
     */
    private function getCoefficient(Shape $intersectable): float|int|null
    {
        if ($this->isShadowed($intersectable)) {
            return null;
        }

        return $intersectable->getReflectionCoefficient($this->light);
    }

    /**
     * @throws Exception
     */
    private function isShadowed(Shape $intersectable): bool
    {
        $l = $this->light->center->sub($intersectable->getLastReflectionPoint());
        $ray = new Ray(
            $intersectable->getLastReflectionPoint(),
            new Direction($l->x, $l->y, $l->z)
        );

        return $this->items->isIntersects($ray);
    }

    /**
     * @throws Exception
     */
    private function calculatePixel(?Shape $intersectable): PixelInterface
    {
        if ($intersectable === null) {
            return $this->pixelFactory->getEmpty();
        }

        $coefficient = $this->getCoefficient($intersectable);

        if ($coefficient === null) {
            return $this->pixelFactory->getShadowed();
        }

        return $this->pixelFactory->fromCoefficient($coefficient);
    }
}