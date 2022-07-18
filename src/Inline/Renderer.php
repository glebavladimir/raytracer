<?php

namespace App\Inline;

class Renderer
{
    private array $rows = [];

    public function __construct(
        public int $width,
        public int $height,
    ) {}

    public function addRow(Row $row): void
    {
        array_push($this->rows, $row);
    }

    public function show()
    {
        echo PHP_EOL;
        foreach ($this->rows as $row) {
            foreach ($row->pixels as $pixel) {
                echo $pixel->lighting;
            }
            echo PHP_EOL;
        }
    }
}
