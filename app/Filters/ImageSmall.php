<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class ImageSmall implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(200, 120);
    }
}