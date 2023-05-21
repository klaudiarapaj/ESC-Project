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
    Route::get('/profile/edit', 'App\Http\Controllers\ProfileController@edit')->name('profile.edit');
    Route::post('/profile/update', 'App\Http\Controllers\ProfileController@update')->name('profile.update');
    Route::post('/users/{user}/follow', 'App\Http\Controllers\UserController@follow')->name('follow');


    Route::post('/posts', 'App\Http\Controllers\PostController@create')->name('post.create');
    Route::get('/posts/{post}', 'App\Http\Controllers\PostController@show')->name('post.show');
    Route::get('/profile/{user:name}', 'App\Http\Controllers\ProfileController@show')->name('profile.show');

    //report
    Route::post('/reports', 'App\Http\Controllers\ReportController@store')->name('reports.store');
   

    //bookmark
    Route::post('/posts/{post}/bookmark', 'App\Http\Controllers\PostController@bookmark')->name('posts.bookmark');
    Route::delete('/posts/{post}/bookmark', 'App\Http\Controllers\PostController@removeBookmark')->name('posts.removeBookmark');
    Route::get('/bookmarks', 'App\Http\Controllers\PostController@showBookmarks')->name('bookmarks');

    //likes
    Route::post('/posts/{post}/like', 'App\Http\Controllers\LikeController@like')->name('posts.like');
    Route::delete('/posts/{post}/unlike', 'App\Http\Controllers\LikeController@like')->name('posts.unlike');


    //comment
    Route::post('/posts/{post}/comment', 'App\Http\Controllers\CommentController@create')->name('comments.create');
    Route::post('/comments',  'App\Http\Controllers\CommentController@store')->name('comments.store');

    //search
    Route::get('/search', 'App\Http\Controllers\SearchController@search')->name('search');

    //display users profile
    Route::get('/users/{user:name}', 'App\Http\Controllers\UserController@show')->name('user.profile');


   
    Route::get('/forums/{name}', 'App\Http\Controllers\ForumController@show')->name('forums.show');
    Route::post('/forums/{forum}/join', 'App\Http\Controllers\ForumController@join')->name('forums.join');
    Route::post('/forum/post', 'App\Http\Controllers\PostController@store')->name('post.store');







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

Route::group(['middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/', 'App\Http\Controllers\AdminPageController@index')->name('admin.index');
    Route::get('/forums', 'App\Http\Controllers\ForumController@index')->name('admin.forums');
    Route::get('/forums/create', 'App\Http\Controllers\ForumController@create')->name('forums.create');
    Route::post('/forums/store', 'App\Http\Controllers\ForumController@store')->name('forums.store');
    Route::get('/forums/{forum}/edit', 'App\Http\Controllers\ForumController@edit')->name('forums.edit');
    Route::put('/forums/{forum}/update', 'App\Http\Controllers\ForumController@update')->name('forums.update');
    Route::delete('/forums/{forum}/delete', 'App\Http\Controllers\ForumController@delete')->name('forums.delete');
    Route::get('/users', 'App\Http\Controllers\UserController@index')->name('admin.users');
    Route::delete('/users/{user}/delete', 'App\Http\Controllers\UserController@delete')->name('users.delete');
    Route::get('/posts', 'App\Http\Controllers\PostController@index')->name('admin.posts');
    Route::delete('/posts/{post}/delete', 'App\Http\Controllers\PostController@delete')->name('posts.delete');

    /*
    Route::delete('/posts/{id}/delete', 'AdminPageController@deletePost')->name('admin.deletePost');
    Route::delete('/forums/{id}/delete', 'AdminPageController@deleteForum')->name('admin.deleteForum');*/
});


// Authentication routes
Auth::routes(['verify' => true]);
