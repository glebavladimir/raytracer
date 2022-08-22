<?php

namespace App\Render;

use App\Shape\Light;
use App\Shape\ShapeCollection;

interface RendererInterface
{
    public function __construct(
        Parameters      $parameters,
        ShapeCollection $items,
        Light           $light,
    );

    public function render(): void;
}