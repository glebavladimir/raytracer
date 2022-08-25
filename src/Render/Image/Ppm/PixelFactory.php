<?php

namespace App\Render\Image\Ppm;

use App\Render\PixelFactoryInterface;
use App\Vector\Color255;

class PixelFactory implements PixelFactoryInterface
{
    const SATURATION_COEFFICIENT = .5;

    private Color255 $baseColor;

    public function fromCoefficient(float $coefficient): Pixel
    {
        return new Pixel(
            Color255::getWhiteColor()->mul($coefficient)
                ->blend(Color255::getDarkRedColor(), 1/self::SATURATION_COEFFICIENT)
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

    public function getShadowed(): Pixel
    {
        return new Pixel(
            Color255::getBlackColor()->blend(Color255::getDarkRedColor(), 1/self::SATURATION_COEFFICIENT)
        );
    }
}
