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

Route::get('/', function () {
    return view('welcome');
});

//write grouped route with prefix "blog" and with name prefixed by "blog."
Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
    Route::get('/', [\App\Http\Controllers\PostController::class,'index'])->name('index');
    Route::get('/{slug}-{id}', [\App\Http\Controllers\PostController::class,'show'])
        //add a constraint to the route to accept only numbers for the id
        //add a constraint to the route to accept only letters and dashes for the slug
        ->where(['id' => '[0-9]+', 'slug' => '[a-z0-9\-]+'])
        ->name('show');
});

