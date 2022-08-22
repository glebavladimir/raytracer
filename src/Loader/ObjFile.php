<?php

namespace App\Loader;

use App\Shape\Shape;
use App\Shape\ShapeCollection;
use App\Shape\Triangle;
use App\Vector\Vertex;

class ObjFile implements Loader
{
    /**
     * @var Vertex[]
     */
    private array $vertices = [];
    /**
     * @var Shape[]
     */
    private array $shapes = [];
    private float $maxVertexValue = 0;
    private float $minVertexValue = 0;

    public function __construct(
        private string $path,
        private int $width,
        private int $height,
    ) {}

    public function loadShapeCollection(): ShapeCollection
    {
        $this->loadShapes();

        return new ShapeCollection($this->shapes);
    }

    private function getVertex(int $index): Vertex
    {
        return $this->vertices[$index - 1];
    }

    private function loadShapes(): void
    {
        $rows = explode(PHP_EOL, file_get_contents($this->path));
        foreach ($rows as $row) {
            $values = $this->getValues($row);
            if (count($values) > 3) {
                if ($values[0] === 'v') {
                    array_push($this->vertices, new Vertex($values[1], $values[2], $values[3]));
                    $this->maxVertexValue = max($this->maxVertexValue, $values[1], $values[2], $values[3]);
                    $this->minVertexValue = min($this->minVertexValue, $values[1], $values[2], $values[3]);
                }
            }
        }
        foreach ($rows as $row) {
            $values = $this->getValues($row);
            if (count($values) > 3) {
                if ($values[0] === 'f') {
                    array_push($this->shapes, new Triangle(
                        $this->getVertex(explode('/', $values[1])[0])->offset($this->getOffset())->mul($this->getMultiplier()),
                        $this->getVertex(explode('/', $values[2])[0])->offset($this->getOffset())->mul($this->getMultiplier()),
                        $this->getVertex(explode('/', $values[3])[0])->offset($this->getOffset())->mul($this->getMultiplier()),
                    ));
                }
            }
        }
    }

    private function getOffset(): float|int
    {
        return -$this->minVertexValue;
    }

    private function getMultiplier(): float|int
    {
        return min($this->width, $this->height) / $this->maxVertexValue / 2;
    }

    /**
     * @param string $row
     * @return array
     */
    private function getValues(string $row): array
    {
        return array_values(array_filter(explode(' ', $row), fn($a) => trim($a) !== ''));
    }
}