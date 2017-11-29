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
        return $this->belongsToMany(Page::class, 'page_relations', 'to_id', 'page_id');
    }

   public function relationsReverse()
    {
        return $this->belongsToMany(Page::class, 'page_relations', 'page_id', 'to_id');
    }


    public function images()
    {
        return $this->morphMany('App\Image', 'imagegable');
    }
    
}
