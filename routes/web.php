<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {

    Route::get('/', 'AdminController@main')->name('admin.main');
    Route::get('/menu', 'AdminController@menu')->name('admin.menu');
    Route::get('/menu/json', 'MenuController@menuJson')->name('admin.menu.json')->middleware('can:admin,auth');
    Route::post('/menu/json', 'MenuController@menuJsonUpdate')->name('admin.menu.json.update')->middleware('can:admin,auth');
    Route::post('/menu/json/create', 'MenuController@create')->name('admin.menu.json.create')->middleware('can:admin,auth');
});

Auth::routes();

Route::get('{page}', 'PageController@show')->name('page.show');
Route::get('/page/search', 'PageController@search')->name('page.search');

//Route::get('{slug}', 'PostController@show')->name('post.show');
/*
Route::resources([
    'page' => 'PageController',
]);*/

//Route::get('/', 'PostController@index');
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

Route::get('/home', 'HomeController@index')->name('home');
