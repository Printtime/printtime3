<?php

namespace App\Http\Resources;

use App\Menu;
use Illuminate\Http\Resources\Json\Resource;

class MenuResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
      
        //return parent::toArray($request);
    }

}
