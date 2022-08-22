<?php

namespace App\Render\Inline;

use App\Render\PixelInterface;

class Pixel implements PixelInterface
{
    const BRIGHT = '#';
    const DARK = '0';
    const DARKER = '*';
    const SHADOWED = '.';
    const EMPTY = ' ';

    public function __construct(
        public string $lighting
    ) {}

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
