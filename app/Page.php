<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Page extends Model
{	
	use Sluggable;

    protected $fillable = [
         'slug',
         'page_types_id',
         'name',
         'anons',
         'content',
         'title',
         'h1',
         'description',
         'keywords',
         'ogtitle',
         'ogdescription',
         'ogtype',
         'robots',
         'changefreq',
         'priority', 
         'published',
         'template',
         'created_at', 
         'updated_at', 

    ];

    protected $casts = [
        'robots' => 'array',
    ];

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeUnpublished($query)
    {
        return $query->where('published', false);
    }

    public function type()
    {
        return $this->belongsTo(PageType::class, 'page_types_id', 'id');
    }

/*    public function types()
    {
        return $this->hasMany(PageType::class, 'id', 'page_types_id');
    }*/
/*    public function types()
    {
        return $this->hasMany(PageType::class);
        #return $this->hasMany(PageType::class, 'page_types_id', 'id')->where('system', 'slider');
    }*/

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value, '-');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

   public function relations()
    {
        return $this->belongsToMany(Page::class, 'page_relations', 'to_id', 'page_id')->orderBy('created_at', 'desc');
    }

   public function relationsReverse()
    {
        return $this->belongsToMany(Page::class, 'page_relations', 'page_id', 'to_id');
    }

   public function relationsWhere($type)
    {   
        $this->type = $type;
        return $this->relations()->whereHas('type', function($q) {
            $q->whereSystem($this->type);
        });
    }

    public function scopeGetImages($q, $s = 'gallery') {
        $this->system = $s;
        $res = $this->morphMany('App\Image', 'imagegable')->whereHas('imagetypes', function ($query) {
            $query->where('system', $this->system);
        }
        )->get();

        return ($res) ? $res : false;
    }
    
    public function scopeGetImage($q, $s = 'gallery') {
        $this->system = $s;
        $res = $this->morphMany('App\Image', 'imagegable')->whereHas('imagetypes', function ($query) {
            $query->where('system', $this->system);
        }
        )->first();

        return ($res) ? $res : false;
    }
        
    public function scopeGetImageType($q, $s = 'gallery') {
        $this->system = $s;
        $filename = '';

        $res = $this->morphMany('App\Image', 'imagegable')->whereHas('imagetypes', function ($query) {
            $query->where('system', $this->system);
        }
        )->first();

        if($res) {
            $filename = $res->filename;
        }

        return $filename;
    }

  public function getImagesPage()
    {
        return $this->morphMany('App\Image', 'imagegable')->with('imagetypes');
    }


    public function images()
    {
        return $this->morphMany('App\Image', 'imagegable');
    }


    public function xavatar()
    {
        return $this->hasMany(Image::class,  'imagegable', 'image_id', 'imagetype_id');
    }

    public function avatar()
    {
        return $this->morphOne('App\Image', 'imagegable')->whereHas('imagetypes', function ($query) {
            $query->where('system', 'avatar');
        }
        );

        #return $this->morphMany('App\Image', 'imagegable');
        #return $this->morphMany('App\Image', 'imagegable');
        #->where('imagetypes.system', '=', 'avatar')
        #return $this->morphMany('App\Image', 'imagegable')->where('imagetypes.system', 'avatar');
    }

    public function stickys()
    {
        return $this->morphMany('App\Image', 'imagegable')->whereHas('imagetypes', function ($query) {
            $query->where('system', 'sticky');
        }
        );
    }

/*    public function img()
    {
        return $this->morphTo('App\Image', 'imagegable');
    }*/

}
