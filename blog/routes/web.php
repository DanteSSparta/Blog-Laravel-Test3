<?php

use App\Task;

Auth::routes();

Route::get('/','PostsController@index')->name('home');
Route::get('/posts/create','PostsController@create');
Route::post('/posts','PostsController@store');
Route::get('/posts/{post}','PostsController@show');
Route::delete('/posts/{post}/delete','PostsController@destroy')->name('posts.destroy');
Route::get('/posts/{post}/edit','PostsController@edit');
Route::patch('/posts/{post}/edit','PostsController@update')->name('posts.update');

Route::get('/posts/tags/{tag}','TagsController@index');

Route::post('/posts/{post}/comments','CommentsController@store');


Route::get('/register','RegistrationController@create');
Route::post('/register','RegistrationController@store');


Route::get('/login','SessionController@create');
Route::post('/login','SessionController@store');

Route::get('/logout','SessionController@destroy');

Route::post('/like','PostsController@likePost')->name('like');

Route::get('/filters', 'WordsFilterController@index');
Route::post('/filters', 'WordsFilterController@store');
Route::delete('/filters/{filter}/delete', 'WordsFilterController@destroy')->name('filters.destroy');
//posts

//GET /posts
//GET /posts/create
//POST /posts
//GET /posts/{id}/edit
//GET /posts/{id}
//PATCH /posts/{id}
//DELETE /posts{id}

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
