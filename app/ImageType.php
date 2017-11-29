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

    
}
