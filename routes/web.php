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
    $posts = \App\Post::get();
    return view('welcome', [
        'posts' => $posts
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post/{slug}', 'PostsController@post');
Route::get('/posts/{page}', 'PostsController@paginate');
