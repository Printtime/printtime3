<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Image;
use App\ImageType;
use App\Page;

use Storage;

// use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{

	public function json(Request $request)
    {

    	//Список
    	if($request->action == 'get' && isset($request->page)) {

    		$page = Page::findorfail($request->page);
    		$images = $page->getImagesPage; 
    		$data = [];
    		foreach ($images as $image) {
    			$data[$image->id] = $image;
    			$data['imagetypes'] = $image->imagetypes;
    			unset($data['imagetypes']);
    		}

    		return response()->json(['images'=>$data, 'types'=>ImageType::get()]);
    	}

    	//Удаление
		if($request->action == 'delete' && isset($request->page) && isset($request->image)) {
			$image = Image::find($request->image);
			$return = Storage::disk('public')->delete('images/'.$image->filename);
			if($return) {
				$image->delete();
			}
			return response()->json($return);
		}

		//Установка типов
		if($request->action == 'type' && isset($request->page) && isset($request->image) && isset($request->type)) {
			$image = Image::find($request->image);
			if($request->data == 'true') {
				$image->imagetypes()->attach($request->type);
			} else {
				$image->imagetypes()->detach($request->type);
			}
			return response()->json($image);
		}

		//Обновление
		if($request->action == 'change' && isset($request->page) && isset($request->image) && isset($request->type)) {
			$image = Image::find($request->image);
			$image->update([$request->type => $request->data]);
			return response()->json($image);
		}


			return response()->json(false);

/*    	$page = \App\Page::find(32);
    	$images = $page->getImagesPage;   
    	return response()->json($images); 	*/
    }

    public function test()
    {


    	$page = \App\Page::find(32);
    	$images = $page->getImagesPage;
    	foreach ($images as $image) {
    		echo $image->imagetypes;
    	}
    	return '-------------------------';

    	//ImageType -> images -> filter ID -> LIST
    	$page = \App\Page::find(32);
    	echo \App\ImageType::whereSystem('gallery')->first()->getImages($page)->get();
    	// echo \App\ImageType::find(2)->getImages($page)->get();
    	return '-------------------------';

    	//ImageType -> images -> filter ID -> LIST
    	$page = \App\Page::find(32);
    	$gallery = \App\ImageType::find(1);
    	echo $gallery->getimages()->where('imagegable_id', $page->id)->get();
    	return '-------------------------';


    	//Page -> images -> LIST
    	$page = \App\Page::find(32);
    	$images = $page->testimages()->get();
    	#->where('id', '1')->get()
    	foreach ($images as $image) {
    		echo $image->imagetypes;
    	}
    	//echo $page;
    	return '-------------------------';


    	#$page = \App\Page::find(32)->testimages()->where('imagetype_id', '1')->get();
    	#$page = \App\Page::find(32)->testimages()->where('imagetype_id', '1')->get();
    	#dd($page->images);
    	
    	$ImageType = \App\ImageType::find(1);
    	dd($ImageType->images);

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


/*
    		$page = Page::findorfail($request->page);
    		$images = $page->getImagesPage; 

    		$data = [];
    		foreach ($images as $image) {
    			$data[$image->id] = $image;
    			$data['imagetypes'] = $image->imagetypes;
    			unset($data['imagetypes']);
    		}
    		*/
    		$data = [];
    		$data = $image;
    		$data['imagetypes'] = $image->imagetypes;

    		return response()->json(['id'=>$image->id, 'data'=>$data]);

    	// return response()->json($upload_success);
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
