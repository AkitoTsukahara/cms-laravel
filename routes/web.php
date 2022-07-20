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

Route::get('/svelte', fn() => view('home'));

Route::get('/posts', \App\Http\Controllers\Post\IndexController::class);
Route::get('/posts/list', \App\Http\Controllers\Post\ListController::class);

Route::get('/tweets', \App\Http\Controllers\Tweet\IndexController::class);
Route::get('/tweets/list', \App\Http\Controllers\Tweet\ListController::class);
