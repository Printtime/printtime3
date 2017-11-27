<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\PageType;

class AdminComposer
{
    public function compose(View $view)
    {
    	$pagetypes = PageType::withCount('pages')->get();
    	$view->with('pagetypes', $pagetypes);
    }
}