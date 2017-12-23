<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeVar extends Model
{
	protected $table = 'type_var';
    protected $fillable = ['price', 'quantity'];
    public $timestamps = false;

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function variable()
    {
        return $this->belongsTo(Variable::class, 'var_id');
    }
}
