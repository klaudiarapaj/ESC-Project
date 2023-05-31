<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


//default
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    } else {
        return redirect()->route('login');
    }
});



Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //profile
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', 'App\Http\Controllers\ProfileController@edit')->name('profile.edit');
    Route::post('/profile/update', 'App\Http\Controllers\ProfileController@update')->name('profile.update');
    Route::post('/users/{user}/follow', 'App\Http\Controllers\UserController@follow')->name('follow');


    //posts
    Route::post('/posts', 'App\Http\Controllers\PostController@create')->name('post.create');
    Route::get('/posts/{post}', 'App\Http\Controllers\PostController@show')->name('post.show');
    Route::get('/profile/{user:name}', 'App\Http\Controllers\ProfileController@show')->name('profile.show');
    Route::delete('/post/{post}/delete', 'App\Http\Controllers\PostController@deletePost')->name('post.delete');


    //bookmark
    Route::post('/posts/{post}/bookmark', 'App\Http\Controllers\PostController@bookmark')->name('posts.bookmark');
    Route::delete('/posts/{post}/bookmark', 'App\Http\Controllers\PostController@removeBookmark')->name('posts.removeBookmark');
    Route::get('/bookmarks', 'App\Http\Controllers\PostController@showBookmarks')->name('bookmarks');

    //likes
    Route::post('/posts/{post}/like', 'App\Http\Controllers\LikeController@like')->name('posts.like');
    Route::delete('/posts/{post}/unlike', 'App\Http\Controllers\LikeController@like')->name('posts.unlike');


    //comment
    Route::post('/posts/{post}/comment', 'App\Http\Controllers\CommentController@create')->name('comments.create');
   

    //search
    Route::get('/search', 'App\Http\Controllers\SearchController@search')->name('search');

    //display users profile
    Route::get('/users/{user:name}', 'App\Http\Controllers\UserController@show')->name('user.profile');

    //report
    Route::get('posts/{post}/report', 'App\Http\Controllers\PostController@report')->name('post.report');
    Route::delete('/report/clear/{id}', 'App\Http\Controllers\PostController@clear')->name('report.clear');


    //forums
    Route::get('/forums/{name}', 'App\Http\Controllers\ForumController@show')->name('forums.show');
    Route::post('/forums/{forum}/join', 'App\Http\Controllers\ForumController@join')->name('forums.join');
    Route::delete('/forums/{forum}/leave', 'App\Http\Controllers\ForumController@leave')->name('forums.leave');
    Route::post('/forum/post', 'App\Http\Controllers\PostController@store')->name('post.store');

    //follow
    Route::post('/users/{user}/follow', 'App\Http\Controllers\FollowController@store')->name('follow');
    Route::post('/users/{user}/unfollow', 'App\Http\Controllers\FollowController@destroy')->name('unfollow');


    //notifications
    Route::get('/notifications', 'App\Http\Controllers\NotificationController@index')->name('notifications.index');
    Route::post('/notifications/mark-as-read', 'App\Http\Controllers\NotificationController@markAsRead')->name('notifications.markAsRead');

    //feedback
    Route::get('/feedback', 'App\Http\Controllers\FeedbackController@index')->name('feedback');
    Route::post('/feedback/store', 'App\Http\Controllers\FeedbackController@store')->name('feedback.store');



    Route::post('/post', function () {
        // logic to create a new post
        return redirect('/');
    });
});


//email verification
Route::get('/email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'show'])
    ->middleware(['auth'])
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.resend');


Route::group(['middleware' => ['guest']], function () {
  
    //login
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
    Route::post('/{user}/update-role', 'App\Http\Controllers\UserController@updateRole')->name('users.updateRole');
    Route::get('/users/search', 'App\Http\Controllers\UserController@search')->name('users.search');
    Route::get('/posts', 'App\Http\Controllers\PostController@showReportedPosts')->name('admin.posts');
    Route::delete('/posts/{post}/delete', 'App\Http\Controllers\PostController@delete')->name('posts.delete');
    Route::get('/feedbacks', 'App\Http\Controllers\FeedbackController@showFeedbacks')->name('admin.feedbacks');
    Route::delete('/feedback/{id}', 'App\Http\Controllers\FeedbackController@destroy')->name('feedback.delete');
});


// Authentication routes
Auth::routes(['verify' => true]);
