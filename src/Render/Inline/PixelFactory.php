<?php

namespace App\Render\Inline;

use App\Render\PixelFactoryInterface;

class PixelFactory implements PixelFactoryInterface
{
    public function fromCoefficient(float $coefficient): Pixel
    {
        return new Pixel(Pixel::getLighting($coefficient));
    }

    public function getEmpty(): Pixel
    {
        return new Pixel(Pixel::EMPTY);
    }

}