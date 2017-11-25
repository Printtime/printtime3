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

	//protected $hidden = ['parent_id', '_lft', '_rgt', 'children', 'page_id'];

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

   public function page()
    {
        return $this->belongsTo(Page::class)->select(['id', 'name', 'slug']);
    }
}
