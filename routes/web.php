<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    } else {
        return redirect()->route('login');
    }
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile');
    Route::post('/profile/update', 'App\Http\Controllers\ProfileController@updateProfile')->name('updateProfile');

    // Route::post('/posts', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    Route::post('/posts', 'App\Http\Controllers\PostController@create')->name('post.create');
    Route::get('/posts/{post}', 'App\Http\Controllers\PostController@show')->name('post.show');
    Route::get('/profile/{user}', 'App\Http\Controllers\ProfileController@show')->name('profile.show');

    //likes
    Route::post('/posts/{post}/like', 'App\Http\Controllers\LikeController@like')->name('posts.like');
    Route::delete('/posts/{post}/unlike', 'App\Http\Controllers\LikeController@like' )->name('posts.unlike');


    Route::post('/post', function () {
        // logic to create a new post
        return redirect('/');
    });
});

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
});

// Authentication routes
Auth::routes(['verify' => true]);
