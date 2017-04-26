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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', 'MainController@index');

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/section/{section}', 'SectionsController@index');

Route::get('/thread/{id}', 'ThreadsController@index');

Route::get('/thread/new/{section_route}', 'ThreadsController@showCreateThreadPage');

Route::get('/profile/{username}', 'ProfilesController@index');

/*
* Admin Routes
*/

// Categories Manipulation
Route::post('/admin/new/category', 'CategoriesController@create');

Route::post('/admin/edit/category/{category_id}', 'CategoriesController@edit');

Route::post('/admin/delete/category/{category_id}', 'CategoriesController@delete');

// Sections Manipulation
Route::post('/admin/new/section/{category_id}', 'SectionsController@create');

Route::post('/admin/edit/section/{section_id}', 'SectionsController@edit');

Route::post('/admin/delete/section/{section_id}', 'SectionsController@delete');

// Threads Manipulation
Route::post('/new/thread/{section_route}', 'ThreadsController@create');

Route::post('/edit/thread/{thread_id}', 'ThreadsController@edit');

Route::post('/delete/thread/{thread_id}', 'ThreadsController@delete');

// Post Manipulation
Route::post('/new/post/{thread_id}', 'PostsController@create');

Route::post('/edit/post/{post_id}', 'PostsController@showEdit');

Route::post('/edit/post/{post_id}/save', 'PostsController@edit');

Route::post('/delete/post/{post_id}', 'PostsController@delete');

// Message Manipulation
// Route::get('message/')