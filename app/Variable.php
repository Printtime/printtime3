<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
	protected $table = 'vars';
    protected $fillable = ['title', 'label'];
    public $timestamps = false;
}
