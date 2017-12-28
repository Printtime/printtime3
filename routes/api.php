<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/price', function (Request $request) {

	header("Access-Control-Allow-Origin: http://php.loc");

    $validation = Validator::make($request->all(),[ 
        'type' => 'required|string',
        'id' => 'required|integer',
    ]);

    if($validation->fails()){
      return response()->json([
		    'error' => ['errors'=>$validation->errors()],
		    'code' => 404,
		    'message' => "Not Found",
		], 404);
    }

		if($request->type == 'products' && $request->id == '9') {
			return DB::table('products')
			->select('id', 'title')
			->where('catalog_id', 9)->get();
		}

		if($request->type == 'types') {
			return \App\Type::where('product_id', $request->id)->select('id', 'title')->get();
		}

		if($request->type == 'vars') {
			return \App\Type::findOrfail($request->id)->variables()->orderBy('order', 'asc')->get();
		}

      return response()->json([
		    'error' => ['errors'=>['price not found']],
		    'code' => 404,
		    'message' => "Not Found",
		], 404);
        // $typevars = \App\TypeVar::with('type', 'variable')->get();
        // return $typevars;
});

// Route::middleware('can:admin')->get('/menu', 'MenuController@jsonMenu')->name('api.jsonMenu');