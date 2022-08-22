<?php

namespace App\Render\Inline;

class Row
{
    /**
     * @param Pixel[] $pixels
     */
    public function __construct(
        public array $pixels = []
    ) {}

    public function addPixel(Pixel $pixel)
    {
        array_push($this->pixels, $pixel);
    }
}
