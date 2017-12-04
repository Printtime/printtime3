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

/*    public function testtypes()
    {
        return $this->hasOne('App\ImageType', 'imagetype_image', 'imagetype_id', 'image_id');
    }*/
/*    public function page()
    {
        #return $this->morphedByMany('App\Page', 'imagegable', 'images', 'id');
        return $this->morphMany('App\Page', 'imagetable');
        #return $this->morphTo('App\Page', 'imagegable', 'images', 'id');
    }*/

    public function getPage()
    {
        #return $this->morphedByMany('App\Page', 'imagegable', 'images', 'id');
        return $this->morphTo('imagegable');
        #return $this->morphedByMany('App\Page', 'imagegable', 'images', 'id');
    }


    public function imagetypes()
    {
        return $this->belongsToMany('App\ImageType', 'imagetype_image', 'image_id', 'imagetype_id');
    }

    public function imagetable()
    {
        return $this->morphTo();
    }
}
