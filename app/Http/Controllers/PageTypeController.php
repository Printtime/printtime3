<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PageType;
use App\Page;

class PageTypeController extends Controller
{
	public function show($pagetype)
	{
	    $pagetype = PageType::findOrFail($pagetype);
	    $pages = $pagetype->pages()->orderBy('updated_at', 'DESC')->paginate();
	    return view('admin.pages', ['name' => $pagetype->title, 'pages' => $pages]);
	}
}
