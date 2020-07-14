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

Route::get('/', ['uses'=>'BlogController@index',
                  'as'=> 'blog'
                  ]);

Route::get('/blog/{post}', [
    'uses'=>'BlogController@show',
    'as'=>'frontend.blog.show'
]);


Route::get('/category/{category}',[
    'uses'=>'BlogController@category',
    'as'=>'category'
]);

Route::get('/author/{author}',[
    'uses'=>'BlogController@author',
    'as'=>'author'
]);

Route::get('/tag/{tag}',[
    'uses'=>'BlogController@tag',
    'as'=>'tag'
]);

Auth::routes();

Route::get('/aboutus', function()
{
    return view('aboutus');
});

Route::put('/blog/restore/{blog}',[
    'uses'=>'Backend\BlogController@restore',
    'as'=>'blog.restore'
]);

Route::delete('/blog/force-destroy/{blog}',[
    'uses'=>'Backend\BlogController@forceDestroy',
    'as'=>'blog.force-destroy'
]);

Route::get('/home', 'Backend\HomeController@index')->name('home');

Route::resource('/backend/blog','Backend\BlogController');

Route::resource('/backend/categories','Backend\CategoriesController');

Route::resource('/backend/users','Backend\UsersController');

Route::resource('/backend/tags', 'Backend\TagsController');

Route::get('/backend/users/confirm/{users}',[
    'uses'=>'Backend\UsersController@confirm',
    'as'=>'backend.users.confirm'
]);

Route::get('/edit-account', 'Backend\HomeController@edit')->name('profile.edit');

Route::put('/edit-account/{id}', 'Backend\HomeController@update')->name('profile.update');
