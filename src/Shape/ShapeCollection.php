<?php

namespace App\Shape;

use Exception;

class ShapeCollection
{
    /**
     * @param Shape[] $items
     */
    public function __construct(
        public array $items
    ) {}

    /**
     * @throws Exception
     */
    public function getClosestIntersected(Ray $ray): ?Shape
    {
        $closest = null;
        foreach ($this->items as $item) {
            if ($item->intersects($ray)) {
                if ($closest === null || $closest->getLastReflectionRayLength() > $item->getLastReflectionRayLength()) {
                    $closest = $item;
                }
            }
        }

        return $closest;
    }
}