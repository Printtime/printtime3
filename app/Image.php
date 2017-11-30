<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  protected $table = 'images';

    protected $fillable = [
        'title',
        'alt',
        'filename',
        'filesize',
        'sorting',
        'published',
        'imagegable_id',
        'imagegable_type',
    ];

    public function testtypes()
    {
        return $this->hasOne('App\ImageType', 'imagetype_image', 'imagetype_id', 'image_id');
    }

    public function imagetypes()
    {
        return $this->belongsToMany('App\ImageType', 'imagetype_image', 'image_id', 'imagetype_id');
         #$this->belongsToMany('App\Image')->using('App\ImageType');
         #return $this->belongTo('');
    }

    public function imagetable()
    {
        return $this->morphTo();
    }
}
