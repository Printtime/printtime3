<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Menu;
use File;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin,auth');
    }

    public function main()
    {
         return view('admin.main');
    }

    public function menu()
    {
         return view('admin.menu', ['menu' => Menu::orderBy('_lft', 'desc')->get()->toTree()]);
    }
    
    public function x3()
    {

/*$res = Menu::orderBy('_lft', 'desc')->get();

foreach ($res as $menu) {
    dd($menu->page->title);
}*/


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

    private function fileList()
    {
        return (object) [
            (object) ['id'=>1, 'name' => 'Подвал', 'dir'=>'resources', 'path' => '/views/widgets/footer.blade.php'],
            (object) ['id'=>2, 'name' => 'CSS стили', 'dir'=>'public', 'path' => '/css/custom.css']
        ];
    }

    public function fileIndex()
    {   
         return view('admin.files.index', ['files' => $this->fileList()]);
    }

    public function fileEdit(Request $request)
    {   
        foreach ($this->fileList() as $file) {
            if($file->id == $request->id) {
                $p = '../'.$file->dir . $file->path;
                $content = File::get($p);
                return view('admin.files.edit', ['file' => $file, 'content' => $content ]);
            }
        }
        return false;
    }

    public function fileUpdate(Request $request)
    {   
        foreach ($this->fileList() as $file) {
            if($file->id == $request->id) {
                $p = '../'.$file->dir . $file->path;
                $content = File::put($p, $request->content);
                return redirect()->route('admin.file.index');
            }
        }
        return false;
    }
}
