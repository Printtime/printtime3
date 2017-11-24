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

	public function show(Request $request, Post $post)
	{
		//$this->authorize('update', $post);
	    return dd($post);
	}

	public function create()
	{
	    return dd('NEW POST');
	}

	public function edit(Request $request, Post $post)
	{
	    //return dd($post);
        return 'Edit поста';
	}

    public function update(Request $request, Post $post)
    {
        return dd('update поста');
    }

}
