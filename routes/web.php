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

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');
Route::get('/admin/draft', 'HomeController@draft');
Route::post('/admin/draft', 'HomeController@save');
Route::get('/admin/trash/{slug}', 'HomeController@trash');

Route::get('/', 'PostsController@home');
Route::get('/post/{slug}', 'PostsController@post');
Route::get('/posts/{page}', 'PostsController@paginate');
