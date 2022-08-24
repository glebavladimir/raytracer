<?php

namespace App\Render\Image\Ppm;

use App\Render\PixelFactoryInterface;
use App\Vector\Color255;

class PixelFactory implements PixelFactoryInterface
{
    const BLEND_WHITE_COEFFICIENT = 1.8;
    const BLEND_GREY_COEFFICIENT = 1.5;

    private Color255 $baseColor;

    public function fromCoefficient(float $coefficient): Pixel
    {
        return new Pixel(
            $this->getBaseColor()
                ->blend(Color255::getWhiteColor()->mul($coefficient), self::BLEND_WHITE_COEFFICIENT)
                ->blend(Color255::getLightGreyColor(), self::BLEND_GREY_COEFFICIENT)
        );
    }

    public function getEmpty(): Pixel
    {
        return new Pixel(Color255::getChromaKeyColor());
    }

    private function getBaseColor(): Color255
    {
        return $this->baseColor ?? Color255::getDarkGreyColor();
    }

    public function setBaseColor(Color255 $baseColor): void
    {
        $this->baseColor = $baseColor;
    }
}
