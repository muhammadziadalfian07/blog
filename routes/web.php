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

Route::get('/home', function () {
    return view('home');
});

Route::resource('/category', 'CategoryController')->except([
    'show'
]);

Route::resource('/tag', 'TagController')->except([
    'show'
]);

Route::resource('/post', 'PostController')->except([
    'show'
]);
Route::get('/post/hapus', 'PostController@tampilHapus')->name('post.tampilHapus');
Route::get('/post/restore/{id}', 'PostController@restore')->name('post.restore');
Route::delete('/post/delete/{id}', 'PostController@delete')->name('post.forceDelete');
