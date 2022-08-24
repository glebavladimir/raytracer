<?php

namespace App\Render;

class RowCollection
{
    /**
     * @param Row[] $rows
     */
    public function __construct(
        public array $rows
    )
    {
    }
}