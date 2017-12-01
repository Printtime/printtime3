<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class ImageFull implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image;
    }
}