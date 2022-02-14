<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    $user = Auth::user();
    return view('home', compact('user'));
});

Auth::routes();

Route::resource("produtos", '\App\Http\Controllers\ProductController');
Route::resource("tags", "\App\Http\Controllers\TagController");

Route::match(['GET', 'POST'], '/pesquisar', '\App\Http\Controllers\ProductController@search')->name('produtos.search');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
