<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Menu;
use App\PageType;
use App\ImageType;

class AppComposer
{
    public function compose(View $view)
    {
    	$menu = Menu::with('page')->orderBy('_lft', 'desc')->get()->toTree();
    	$view->with('menu', $menu);


        $types = ImageType::whereSystem('slider')->first();
        $sliders = $types->imagetypesReverse();
        $view->with('sliders', $sliders->with('getPage')->get());
        
        #$sliders = $sliders->with('pages');
        #$view->with('sliders', $sliders->with('pages')->get());

        #$view->with('sliders', $sliders->get());

        #return dd($sliders->with('getPage')->get());
        //$sliders = PageType::with('pages')->where('system', 'slider')->first();
        //dd($sliders->pages->first());
    	//$view->with('sliders', $sliders->pages);
    }
}