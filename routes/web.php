<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Router index yang tampil pertama kali ketika mengakses web
Route::get('/', 'App\Http\Controllers\ListOfBooksController@index')->name('books.index');

// Router untuk author
Route::get('/famous-author', 'App\Http\Controllers\AuthorController@index')->name('author.index');

// Router untuk rating
Route::get('/form-add-rating', 'App\Http\Controllers\RatingController@index')->name('rating.index');
Route::post('/rating/add', 'App\Http\Controllers\RatingController@insert')->name('rating.insert');
//Ajax untuk mengambil buku berdasarkan author nya
Route::get('/authors/book', 'App\Http\Controllers\RatingController@getBookByAuthor')->name('ajax.getBookByAuthor');
