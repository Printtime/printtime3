<?php

Route::get('/sitemap.xml', 'PageController@sitemap')->name('page.sitemap');

Route::post('/send', 'MailController@send')->name('send.mail');

Route::group(['prefix' => 'admin'], function () {

	Route::get('/', 'AdminController@main')->name('admin.main');

	Route::post('/image/upload', 'ImageController@upload')->name('admin.image.upload')->middleware('can:admin,auth');
	Route::get('/image/json', 'ImageController@json')->name('admin.page.json')->middleware('can:admin,auth');
	Route::post('/image/json', 'ImageController@json')->name('admin.page.json')->middleware('can:admin,auth');

	//File manager
	Route::group(['prefix' => 'files'], function () {
		Route::get('/', 'AdminController@fileIndex')->name('admin.file.index');
		Route::get('edit', 'AdminController@fileEdit')->name('admin.file.edit');
		Route::post('edit', 'AdminController@fileUpdate')->name('admin.file.update');
	});

	//TEST
	#Route::get('/test', 'ImageController@test')->name('admin.test')->middleware('can:admin,auth');

	Route::get('/pagetype/{pagetype}', 'PageTypeController@show')->name('admin.pagetype.show')->middleware('can:admin,auth');
	Route::get('/page/{page}/relations', 'PageController@relations')->name('admin.page.relations')->middleware('can:admin,auth');

	Route::get('/page', 'PageController@create')->name('admin.page.create')->middleware('can:admin,auth');
	Route::post('/page/json', 'PageController@json')->name('admin.page.json')->middleware('can:admin,auth');
	Route::get('/page/{page}/edit', 'PageController@create')->name('admin.page.edit')->middleware('can:admin,auth');
	Route::get('/page/{page}/delete', 'PageController@delete')->name('admin.page.delete')->middleware('can:admin,auth');
	Route::post('/page', 'PageController@store')->name('admin.page.store')->middleware('can:admin,auth');
	Route::post('/page/{page}', 'PageController@update')->name('admin.page.update')->middleware('can:admin,auth');

	Route::get('/menu', 'AdminController@menu')->name('admin.menu');
	Route::get('/menu/json', 'MenuController@menuJson')->name('admin.menu.json')->middleware('can:admin,auth');
	Route::post('/menu/json', 'MenuController@menuJsonUpdate')->name('admin.menu.json.update')->middleware('can:admin,auth');
	Route::post('/menu/json/create', 'MenuController@store')->name('admin.menu.json.create')->middleware('can:admin,auth');
	Route::delete('/menu/json/delete', 'MenuController@delete')->name('admin.menu.json.delete')->middleware('can:admin,auth');

	//TypeVar
	Route::get('/typevar', 'AdminController@TypeVarIndex')->name('admin.typevar.index');
	Route::post('/typevar/update', 'AdminController@TypeVarUpdate')->name('admin.typevar.update');

});

Auth::routes();

Route::get('/', 'PageController@home')->name('page.home');

#Route::get('{page}', 'PageController@show')->name('page.show');
#Route::paginate('/{page}', [ 'as'=>'news', 'uses' => 'PageController@show' ] );

Route::get('{slug}', 'PageController@show')->where('slug', '[A-Za-z0-9-]+')->name('page.show');
//Route::get('{page}/{number}', 'PageController@show')->where('page', '[A-Za-z0-9]+')->where('number', '[0-9]+');
//Route::get('{page}', 'PageController@show')->where('page', '[A-Za-z0-9-]+')->name('page.show');
#Route::get('{page}', 'PageController@show')->name('page.show');
Route::get('/page/search', 'PageController@search')->name('page.search');

// Route::get('/home', 'HomeController@index')->name('home');

//Route::get('{slug}', 'PostController@show')->name('post.show');
/*
Route::resources([
'page' => 'PageController',
]);*/

//Route::get('/', 'PostController@index');

/*
Route::get('/posts', 'PostController@index')->name('list_posts');
Route::group(['prefix' => 'posts'], function () {
Route::get('/drafts', 'PostController@drafts')->name('list_drafts')->middleware('auth');
Route::get('/show/{id}', 'PostController@show')->name('show_post')->middleware('can:postsview');
Route::get('/create', 'PostController@create')->name('create_post')->middleware('can:create-post');
Route::post('/create', 'PostController@store')->name('store_post')->middleware('can:create-post');
Route::get('/edit/{post}', 'PostController@edit')->name('edit_post')->middleware('can:posts-update,post');
Route::post('/edit/{post}', 'PostController@update')->name('update_post')->middleware('can:posts-update,post');
// using get to simplify
Route::get('/publish/{post}', 'PostController@publish')->name('publish_post')->middleware('can:publish-post');
});
 */
