<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class ImageMedium implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(480, 360);
    }
}