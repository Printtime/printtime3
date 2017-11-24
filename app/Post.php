<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{	
    protected $table = 'posts';

    protected $fillable = [
        'title', 'slug', 'body',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeUnpublished($query)
    {
        return $query->where('published', false);
    }
}
