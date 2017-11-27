<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\PageType;

class PageController extends Controller
{
	public function index()
	{
	    $pages = Page::published()->paginate();
	    return dd($pages);
	}


	public function show(Request $request)
	{	
	 	$page = (is_numeric($request->page) ? Page::findOrFail($request->page) : Page::published()->whereSlug($request->page)->firstOrFail());
		dd($page);
		//return $page->type->title;
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


	public function create($page = null)
	{	

		$changefreq_array = [
			'always' => 'Всегда',
			'hourly' => 'Почасово',
			'daily' => 'Ежедневно',
			'weekly' => 'Еженедельно',
			'monthly' => 'Ежемесячно',
			'yearly' => 'Раз в год',
			'never' => 'Никогда'
		];

		$pagetypes = collect(PageType::get());
		$pagetypes_plucked = $pagetypes->pluck('title', 'id');
		$pagetypes_plucked->all();
		
		if($page == null) {
			$page = new Page();
	 	} else {
	 		$page = Page::findOrFail($page);
	 	}


        return view('admin.page', ['page' => $page, 'changefreq_array' => $changefreq_array, 'pagetypes'=>$pagetypes_plucked]);
	}

	public function store(Request $request)
	{	
		$page = new Page();
		$page->fill($request->all());
		if($request->published == 'on') { $page->published = true; } else { $page->published = false; }
		if(empty($request->created_at)) { unset($page->created_at); }
		if(empty($request->updated_at)) { unset($page->updated_at); }
		$page->save();

		return redirect()->back();
	}


	public function update(Request $request, Page $page)
	{	
		$page->fill($request->all());

		if($request->published == 'on') { $page->published = true; } else { $page->published = false; }
		$page->save();

		return redirect()->back();
	}

}
