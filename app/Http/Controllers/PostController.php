<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{

	public function index()
	{
	    $posts = Post::published()->paginate();
	    return dd($posts);
	}

	public function create()
	{
	    return dd('NEW POST');
	}

	public function edit(Request $request)
	{
        return 'Edit поста';
	}

    public function update(Request $request, $id)
    {
        return dd('update поста');
    }

}
