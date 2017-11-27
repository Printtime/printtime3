<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PageType;
use App\Page;

class PageTypeController extends Controller
{
	public function show($pagetype)
	{
	    $pagetype = PageType::findOrFail($pagetype)->pages()->orderBy('updated_at', 'DESC')->paginate();
	    #$pagetype = Page::where('page_types_id', $pagetype)->paginate();
	    return view('admin.pages', ['pages' => $pagetype]);
	}
}
