<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Image;
use Storage;

class ImageController extends Controller
{
    public function test()
    {
    	
    	$page = \App\Page::find(32);
    	dd($page->images);
    	
    	
    	/*
    	$img = \App\Image::with('imagetypes')->find(4);
    	dd($img->imagetypes);
    	*/
    }

    public function upload(Request $request)
    {

    	// $x = $request->all();
    	// return response()->json($x);

		$request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

    	$image = $request->file;

    	// $response['mime'] = $image->getMimeType();
    	$response['filesize'] = $image->getSize();
    	$response['filename'] = md5(time().$response['filesize']).'.'.$image->getClientOriginalExtension();

    	//$destinationPath = 'app/storage/public/images';
    	$destinationPath = storage_path('app/public/images');
				
                 $upload_success = $image->move($destinationPath, $response['filename']);
                 if($upload_success) {
                    $image = new Image;
                    $image->title = $request->file_name;
                    $image->alt = $request->file_name;
                    $image->filename = $response['filename'];
                    $image->filesize = $response['filesize'];
                    $image->imagegable_id = $request->page;
                    $image->imagegable_type = 'App\Page';
                    $image->save();


                    $image->imagetypes()->attach(1);

                 }

    	return response()->json($upload_success);
    	#return response()->json($request->file);

/*        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);*/

    	// $files = Storage::disk('public');
    	// return $files;
    	/*$data = $request->except(['_token']);
    	$post = Post::updateOrCreate(['id' => $request->id], $data);
        #$this->multiple_slide_upload($post, $request);
        $this->multiple_image_upload($post->id, $request, 'App\Post');
        return redirect()->route('admin.index.post');*/
    }

    public function multiple_image_upload($id, Request $request, $imagegable_type)
    {   
        if($request->images) {
            foreach ($request->images as $image) {
                 $filesize = $image->getSize();
                 $filename = md5(time().$filesize).'.'.$image->getClientOriginalExtension();
                 $destinationPath = 'storage/images';
                 $upload_success = $image->move($destinationPath, $filename);
                 if($upload_success) {
                    $image = new Image;
                    $image->filename = $filename;
                    $image->filesize = $filesize;
                    $image->imagegable_id = $id;
                    $image->imagegable_type = $imagegable_type;
                    $image->save();
                 }
            }
        }
    }

    public function update($id, $type)
    {	
	    $image = Image::find($id);
	   if($type == 'delete') {
	    	$filename = $image->filename;
	    	$res = $image->delete();
	    	
	    	if($res) {
	    		Storage::disk('images')->delete($filename);
	    	}
	    }
	    if($type == 'avatar') {
			Image::where('imagegable_id', $image->imagegable_id)->where('imagegable_type', $image->imagegable_type)->update(['avatar' => false]);
	    	$image->avatar = true;
	    	$image->save();
	    }
	    return back();
    }
}
