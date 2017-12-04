<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageType extends Model
{
  protected $table = 'imagetypes';

    protected $fillable = [
        'title',
        'system',
    ];

    public function images()
    {
        return $this->hasMany('App\Image', 'imagetype_image', 'image_id', 'imagetype_id');
    }

    public function imagetypesReverse()
    {
        return $this->belongsToMany('App\Image', 'imagetype_image', 'imagetype_id', 'image_id');
    }

    public function getImages($page)
    {	

        return $this->belongsToMany('App\Image', 'imagetype_image', 'imagetype_id', 'image_id')
			        ->where('imagegable_id', $page->id)
			        ->where('imagegable_type', 'App\Page');
    }

}
