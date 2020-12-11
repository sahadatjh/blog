<?php

use Illuminate\Support\Facades\Route;

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
//     return view('frontend.pages.home');
// });
Route::get('/','FrontendHomeController@index');
Route::get('/blog/posts','FrontendHomeController@blogPosts')->name('blog.posts');
Route::get('/posts-by-category/{catagory_id}','FrontendHomeController@blogPostByCatagory');
// Route::get('/single/post','FrontendHomeController@singlePost')->name('single.post');
Route::get('post/{post_id}','FrontendHomeController@singlePost');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');
//Route for catagory
Route::get('/manage/catagory','CatagoryController@index')->name('catagories');
Route::get('/add/catagory','CatagoryController@create')->name('add.catagory');
Route::post('/store/catagory','CatagoryController@store')->name('store.catagory');
Route::get('delete/catagory/{id}','CatagoryController@destroy');
Route::get('publish/catagory/{id}','CatagoryController@publishCatagory');
Route::get('unpublish/catagory/{id}','CatagoryController@unpublishCatagory');
Route::get('edit/catagory/{id}','CatagoryController@edit');
Route::post('/update/catagory/','CatagoryController@update')->name('update.catagory');

//route for posts
Route::get('/posts','PostController@index')->name('posts');
Route::get('/add/posts','PostController@create')->name('add.post');
Route::post('/store/post','PostController@store')->name('store.post');
Route::get('publish/post/{id}','PostController@publishPost');
Route::get('unpublish/post/{id}','PostController@unpublishPost');
Route::get('delete/post/{id}','PostController@destroy');
Route::get('edit/post/{id}','PostController@edit');
Route::post('/update/post/','PostController@update')->name('update.post');