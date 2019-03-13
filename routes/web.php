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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('books', 'BookController');
Route::resource('lendings', 'LendingController');
Route::resource('authors', 'AuthorController');

Route::get('books/addCart/{id}', 'BookController@addCart');
//Route::get('books/openCart', 'BookController@openCart')->name('openCart');
Route::get('carrinho', 'BookController@openCart');
Route::get('lend', 'LendingController@lending')->name('lend');
