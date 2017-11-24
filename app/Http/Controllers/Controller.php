<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Menu;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

   	public function getMenu()
    {

    	/*

        data: [
				    {
				        name: 'node1',
				        children: [
				            { name: 'child1' },
				            { name: 'child2' }
				        ]
				    },
				    {
				        name: 'node2',
				        children: [
				            { name: 'child3' }
				        ]
				    }
				],

				*/
    	$menu = [
				    [
				        'label' => 'node 1',
				        'id' => '1',
				        'children' => [
				            [ 'label' => 'child1', 'id' => 'c1' ],
				            [ 'label' => 'child2', 'id' => 'c2' ]
				        ]
				    ],
				    [
				        'label' => 'node2',
				        'id' => '2',
				        'children'=> [
				            [ 'label' => 'child4', 'id' => 'c4' ],
				            [ 'label' => 'child5', 'id' => 'c5' ],
				            [ 'label' => 'child6', 'id' => 'c6' ]
				        ]
				    ]
				];

    	return response()->json($menu);
    }

}
