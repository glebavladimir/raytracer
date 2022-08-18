<?php

namespace App\Shape;

class IntersectableCollection
{
    /**
     * @param Intersectable[] $items
     */
    public function __construct(
        public array $items
    ) {}

    public function getClosestIntersected(Ray $ray): ?Intersectable
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