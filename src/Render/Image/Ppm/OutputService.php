<?php

namespace App\Render\Image\Ppm;

use App\Render\OutputInterface;
use App\Render\RowCollection;
use Exception;

class OutputService implements OutputInterface
{
    const SIZE = 255;
    const COLOR_SCHEME = 'P3';
    const COLORS_SEPARATOR = ' ';

    private string $data = '';

    public function __construct(
        private string $outputPath,
        private int $width,
        private int $height,
    )
    {
    }

    /**
     * @throws Exception
     */
    public function output(RowCollection $rowCollection)
    {
        $this->data .= self::COLOR_SCHEME . PHP_EOL;
        $this->data .= $this->width . PHP_EOL;
        $this->data .= $this->height . PHP_EOL;
        $this->data .= self::SIZE . PHP_EOL;

        foreach ($rowCollection->rows as $row) {
            foreach ($row->pixels as $pixel) {
                if (!$pixel instanceof Pixel) {
                    throw new Exception(
                        "In order to be outputted with this service, all Pixel objects should be instances " .
                        "of App\Render\Inline\Pixel class."
                    );
                }
                $this->data .= implode(self::COLORS_SEPARATOR, [
                    $pixel->color->getRed(),
                    $pixel->color->getGreen(),
                    $pixel->color->getBlue(),
                ]) . PHP_EOL;
            }
        }

        file_put_contents($this->outputPath, $this->data);
    }
}