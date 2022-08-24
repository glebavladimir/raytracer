<?php

namespace App\Render\Inline;

use App\Render\OutputInterface;
use App\Render\RowCollection;
use Exception;

class OutputService implements OutputInterface
{

    /**
     * @throws Exception
     */
    public function output(RowCollection $rowCollection)
    {
        echo PHP_EOL;
        foreach ($rowCollection->rows as $row) {
            foreach ($row->pixels as $pixel) {
                if (!$pixel instanceof Pixel) {
                    throw new Exception(
                        "In order to be outputted with this service, all Pixel objects should be instances " .
                        "of App\Render\Inline\Pixel class."
                    );
                }
                echo $pixel->lighting;
            }
            echo PHP_EOL;
        }
    }
}
