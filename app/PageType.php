<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageType extends Model
{
    public function pages()
    {
        return $this->hasMany(Page::class, 'page_types_id', 'id');
    }
}
