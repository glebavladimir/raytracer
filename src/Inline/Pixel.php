<?php

namespace App\Inline;

use JetBrains\PhpStorm\Pure;

class Pixel
{
    const BRIGHT = '#';
    const DARK = '0';
    const DARKER = '*';
    const SHADOWED = '.';
    const EMPTY = ' ';

    public function __construct(
        public string $lighting
    ) {}

    #[Pure] public static function fromProduct(float $product): self
    {
        return new self(Pixel::getLighting($product));
    }

    public static function getLighting(float $a): string
    {
        return match(true) {
            $a >= .8 => self::BRIGHT,
            $a >= .5 && $a < .8 => self::DARK,
            $a >= .2 && $a < .5 => self::DARKER,
            $a >= 0 && $a < .2 => self::SHADOWED,
            default => self::EMPTY,
        };
    }
}
