<?php

namespace App\Inline;

class Parameters
{
    public function __construct(
        public int $width,
        public int $height,
    ) {}
}