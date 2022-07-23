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

Route::get('/posts', \App\Http\Controllers\Post\IndexController::class)->name('post.index');
Route::get('/posts/list', \App\Http\Controllers\Post\ListController::class);
Route::get('/posts/create', \App\Http\Controllers\Post\CreateController::class)->name('post.create');

Route::get('/tweets', \App\Http\Controllers\Tweet\IndexController::class)->name('tweet.index');
Route::get('/tweets/list', \App\Http\Controllers\Tweet\ListController::class);
Route::get('/tweets/create', \App\Http\Controllers\Tweet\CreateController::class)->name('tweet.create');
