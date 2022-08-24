<?php

namespace App\Render;

interface PixelFactoryInterface
{
    public function fromCoefficient(float $coefficient): PixelInterface;
    public function getEmpty(): PixelInterface;
    public function getShadowed(): PixelInterface;
}