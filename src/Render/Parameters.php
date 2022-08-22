<?php

namespace App\Render;

class Parameters
{
    public function __construct(
        public int $width,
        public int $height,
    ) {}
}