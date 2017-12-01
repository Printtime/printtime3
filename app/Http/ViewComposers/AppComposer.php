<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Menu;

class AppComposer
{
    public function compose(View $view)
    {
    	$menu = Menu::with('page')->orderBy('_lft', 'desc')->get()->toTree();
    	$view->with('menu', $menu);
    }
}