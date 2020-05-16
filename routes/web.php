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


Route::get('/', 'BlogController@index');
// route::get('/isipost', function () {
//     return view('blog.isi_post');
// });

Route::get('/posts/{slug}', 'BlogController@isi_blog')->name('isi.post');
Route::get('/list-post', 'BlogController@listBlog')->name('list.blog');
Route::get('/post-category/{category}', 'BlogController@listCategory')->name('blog.category');
Route::get('/cari', 'BlogController@cari')->name('blog.cari');

Route::group(['middleware' => 'auth'], function () {
    //home
    Route::get('/home', 'HomeController@index')->name('home');

    //route category
    Route::resource('/category', 'CategoryController')->except([
        'show'
    ]);

    //route tag
    Route::resource('/tag', 'TagController')->except([
        'show'
    ]);

    //route post
    Route::resource('/post', 'PostController')->except([
        'show'
    ]);
    Route::get('/post/hapus', 'PostController@tampilHapus')->name('post.tampilHapus');
    Route::get('/post/restore/{id}', 'PostController@restore')->name('post.restore');
    Route::delete('/post/delete/{id}', 'PostController@delete')->name('post.forceDelete');

    //route user
    Route::resource('/user', 'UserController')->except([
        'show'
    ]);
});




Auth::routes();
