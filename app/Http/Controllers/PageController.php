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
		return $page->type->name;
	}

	public function search(Request $request)
	{
	    $term = $request->input('term');
	    $term = htmlentities($term);

	    $pages = Page::published()
	    ->where('name', 'like', '%' . $term . '%')
	    ->orWhere('slug', 'like', '%' . $term . '%')
	    ->select(['id', 'name', 'slug'])->get();

	    $res = [];
	    if($pages) {
		    foreach ($pages as $page) {
				$res[] = [
					'id' => $page->id,
					'name' => $page->name,
					'label' => $page->name,
					'slug' => $page->slug,
				];
		    }
	    }
	    return $res;

	}

}
