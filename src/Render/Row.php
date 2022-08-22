<?php

namespace App\Render;

class Row
{
    /**
     * @param PixelInterface[] $pixels
     */
    public function __construct(
        public array $pixels = []
    ) {}

    public function addPixel(PixelInterface $pixel)
    {
        array_push($this->pixels, $pixel);
    }
}
