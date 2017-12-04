<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class ImageSmall implements FilterInterface
{
    public function applyFilter(Image $image)
    {

		return $image->resize(300, null, function ($constraint) {
		    $constraint->aspectRatio();
		});
        //return $image->resize(null, 120);
    }
}