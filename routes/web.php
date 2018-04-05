<?php

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/admin/draft', 'AdminController@draft');
Route::post('/admin/draft', 'AdminController@save');
Route::get('/admin/trash/{slug}', 'AdminController@trash');

Route::get('/', 'PostsController@home');
Route::get('/post/{post}', 'PostsController@post')->name('post');
Route::get('/posts/{page}', 'PostsController@paginate');
