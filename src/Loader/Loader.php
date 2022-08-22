<?php

namespace App\Loader;

use App\Shape\ShapeCollection;

interface Loader
{
    public function loadShapeCollection(): ShapeCollection;
}