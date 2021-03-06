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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/posts/{post}','App\Http\Controllers\Blog\PostsController@show');



Route::middleware(['auth'])->group(function(){

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('categories','App\Http\Controllers\CategoriesController');

Route::resource('posts','App\Http\Controllers\PostsController')->middleware('verifyCategoriesCount' );

Route::get('trashed-posts','App\Http\Controllers\PostsController@trashed')->name('trashed-posts.index');

Route::put('restore-post/{post}','App\Http\Controllers\PostsController@restore')->name('restore-posts');

Route::resource('tags','App\Http\Controllers\TagsController');

});

Route::middleware(['auth','admin'])->group(function(){

Route::get('users/profile','App\Http\Controllers\UsersController@edit')->name('users.edit-profile');

Route::get('users','App\Http\Controllers\UsersController@index');

Route::put('users/profile','App\Http\Controllers\UsersController@update')->name('users.update-profile');

Route::post('users/{user}/make-admin','App\Http\Controllers\UsersController@makeAdmin')->name('users.make-admin');

});
