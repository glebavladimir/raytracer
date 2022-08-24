<?php

namespace App\Render;

use App\Shape\Light;
use App\Shape\ShapeCollection;

interface RendererInterface
{
    public function render(): void;
}