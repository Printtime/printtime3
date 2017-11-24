<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class PageController extends Controller
{
	public function index()
	{
	    $pages = Page::published()->paginate();
	    return dd($pages);
	}

	public function show(Request $request)
	{	
	 	$page = (is_numeric($request->page) ? Page::findOrFail($request->page) : Page::published()->whereSlug($request->id)->firstOrFail());
		//return dd($page);
		return $page->type->title;
	}


}
