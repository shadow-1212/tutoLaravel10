<?php

use App\Http\Controllers\PostController;
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
Route::group(['prefix' => 'blog', 'as' => 'blog.', 'controller' => PostController::class], function () {
    Route::get('/','index')->name('index');
    Route::get('/{slug}-{post}', 'show')
        //add a constraint to the route to accept only numbers for the id
        //add a constraint to the route to accept only letters and dashes for the slug
        ->where(['post' => '[0-9]+', 'slug' => '[a-z0-9\-]+'])
        ->name('show');
    /*
    Route::get('/{post:slug}', 'show')
        //add a constraint to the route to accept only numbers for the id
        //add a constraint to the route to accept only letters and dashes for the slug
        ->where(['post' => '[a-z0-9\-]+'])
        ->name('show');
    */

    //create a group having middleware auth routes
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/{post}/edit', 'edit')->name('edit');
        Route::post('/{post}/edit', 'update');
        Route::get('/new','create')->name('create');
        Route::post('/new','store')->name('store');
    });
});


//auth route
Route::get('/login',[\App\Http\Controllers\AuthController::class,'loginForm'])->name('auth.login');
Route::post('/login',[\App\Http\Controllers\AuthController::class,'login']);
Route::delete('/logout',[\App\Http\Controllers\AuthController::class,'logout'])->name('auth.logout');
