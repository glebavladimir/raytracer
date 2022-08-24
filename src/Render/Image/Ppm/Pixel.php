<?php

namespace App\Render\Image\Ppm;

use App\Render\PixelInterface;
use App\Vector\Color255;

class Pixel implements PixelInterface
{
    public function __construct(
        public Color255 $color
    )
    {
    }
}
