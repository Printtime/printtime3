<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Menu;
// use App\Http\Resources\MenuResource;

class MenuController extends Controller
{
	/*
    public function index_menu()
    {
    	
    	#return MenuResource::collection(Menu::all());
    	#$menu = Menu::get();
        #return new MenuResource($menu);
    	//return dd($this->get_menu());
    	//return $this->jsonMenu();
    }*/
    public function create(Request $request)
    {
        $moved = new Menu();
        $moved->name = $request->input('name');
        $moved->page_id = $request->input('page_id');
        $moved->save();
        
        $target = Menu::with('page')->orderBy('_lft', 'asc')->first();
        
        $moved->insertBeforeNode($target);
        
        return $moved;
    }

    public function menuJsonUpdate(Request $request)
    {	
    	//return Menu::fixTree();

    	$moved = $request->input('moved');
    	$target = $request->input('target');
    	$position = $request->input('position');

		$moved = Menu::find($moved);
		$target = Menu::find($target);

		
    	if($position == 'inside') {
    		$target->appendNode($moved);
    	}
    	if($position == 'after') {
    		$moved->insertBeforeNode($target);
    	}
    	if($position == 'before') {
    		$moved->insertAfterNode($target);
    	}

    	return response()->json(true);
    }

    public function menuJson()
    {
    	$menu = Menu::with('page')->orderBy('_lft', 'desc')->get()->toTree();

			$traverse = function ($menu) use (&$traverse) {

    		$response = [];


			    foreach ($menu as $item) {	

			    if($item->children->count() >= 1)  {
			    	$response[] = [
			    		'id'=>$item->id,
			    		'label' => $item->name,
			    		'children' => $item->children,
			    		'page' => $item->page,

			    	];
			    } else {
			    	$response[] = [
			    		'id'=>$item->id,
			    		'label' => $item->name,
			    		'page' => $item->page,
			    	];
			    }


			    	 $traverse($item->children);
			    	/*
			        echo PHP_EOL.$prefix.' '.$item->name;
			        echo "<br>";
			        $traverse($item->children, $prefix.'-');
			        */
			    }
			    return $response;
			};

		return $traverse($menu);
    }

}
