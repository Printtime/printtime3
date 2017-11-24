<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Menu;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin,auth');
    }


    
    public function main()
    {

    	 return view('admin.menu', ['menu' => Menu::get()->toTree()]);

//return Menu::fixTree();

$neighbor = Menu::find(2);
$node = Menu::find(6);
$node->afterNode($neighbor)->save();

/*
//Вложить в ...
$parent = Menu::find(1);
$node = Menu::find(2);
$res = $parent->prependNode($node);
//return dd($res);
*/

/*
$node = Menu::find(2);
$node->saveAsRoot();
*/

/*
//Создание
$node = new Menu(['name'=>'Тест 2']);
$res = $node->save();
if ($res) {
    $moved = $node->hasMoved();
}
return dd($res);
*/


/*
//Внедрение prependToNode
$parent = Menu::find(1);
$node = new Menu(['name'=>'Тест 1']);
//$res = $node->prependToNode($parent)->save();
$res = $parent->prependNode($node);
return dd($res);
*/


//Генерация дерева
			$nodes = Menu::get()->toTree();

			$traverse = function ($categories, $prefix = '-') use (&$traverse) {
			    foreach ($categories as $category) {
			        echo PHP_EOL.$prefix.' '.$category->name;
			        echo "<br>";

			        $traverse($category->children, $prefix.'-');
			    }
			};

			$traverse($nodes);


    	//Menu::fixTree();
        
        return dd('Admin main');
    	//$res = User::roles()->where('slug', $roleSlug)->count()->get();
    	//$res = User::roles()->where('slug', $roleSlug)->count()->get();
    	 $res = auth()->user();
    	return dd($res->inRole('admin'));
        return dd('Admin main');
    }
}
