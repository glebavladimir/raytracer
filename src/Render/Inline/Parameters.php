<?php

namespace App\Render\Inline;

class Parameters
{
    public function __construct(
        public int $width,
        public int $height,
    ) {}
}