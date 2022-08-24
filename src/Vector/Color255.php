<?php

namespace App\Vector;

class Color255 extends Vector3
{
    const MIN_VALUE = 0;
    const MAX_VALUE = 255;

    public function __construct(
        int|float $red,
        int|float $green,
        int|float $blue
    )
    {
        parent::__construct(
            $this->restrict($red),
            $this->restrict($green),
            $this->restrict($blue),
        );
    }

    public function blend(Color255 $color, float $coefficient): Color255
    {
        return new Color255(
            ($this->getRed() + $color->getRed() ) / $coefficient,
            ($this->getGreen() + $color->getGreen() ) / $coefficient,
            ($this->getBlue() + $color->getBlue() ) / $coefficient,
        );
    }

    public static function getChromaKeyColor(): Color255
    {
        return new self(4, 244, 4);
    }

    public static function getWhiteColor(): Color255
    {
        return new self(255, 255, 255);
    }

    public static function getDarkGreyColor(): Color255
    {
        return new self(100, 100, 100);
    }

    public static function getLightGreyColor(): Color255
    {
        return new self(200, 200, 200);
    }

    private function restrict(int|float $colorChannel): int
    {
        if ($colorChannel < self::MIN_VALUE) {
            return self::MIN_VALUE;
        }
        if ($colorChannel > self::MAX_VALUE) {
            return self::MAX_VALUE;
        }

        return (int) $colorChannel;
    }

    public function getRed(): int
    {
        return $this->x;
    }

    public function setRed(int $red): void
    {
        $this->x = $red;
    }

    public function getGreen(): int
    {
        return $this->y;
    }

    public function setGreen(int $green): void
    {
        $this->y = $green;
    }

    public function getBlue(): int
    {
        return $this->z;
    }

    public function setBlue(int $blue): void
    {
        $this->z = $blue;
    }
}