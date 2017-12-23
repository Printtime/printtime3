<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
	protected $table = 'types';
    protected $fillable = ['title', 'product_id', 'width', 'height', 'semantic', 'roll_width'];
    public $timestamps = false;

/*    public function product()
    {
        return $this->belongsTo(Product::class);
    }*/

    public function variables()
    {
        return $this->belongsToMany(Variable::class, 'type_var', 'type_id', 'var_id')->withPivot('price', 'quantity');
    }

    public function variable()
    {
        return $this->belongsTo(Variable::class, 'type_var', 'type_id', 'var_id')->withPivot('price', 'quantity');
    }
}
