<?php

namespace App\Render;

interface OutputInterface
{
    public function output(RowCollection $rowCollection);
}