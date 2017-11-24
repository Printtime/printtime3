<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Menu extends Model
{
	use NodeTrait;

    protected $table = 'menu';

    protected $fillable = [
        'name', 'parent_id', '_lft', '_rgt'
    ];

    public $timestamps = false;

	public function getLftName()
	{
	    return '_lft';
	}

	public function getRgtName()
	{
	    return '_rgt';
	}

	public function getParentIdName()
	{
	    return 'parent_id';
	}

	// Specify parent id attribute mutator
	public function setParentAttribute($value)
	{
	    $this->setParentIdAttribute($value);
	}

}
