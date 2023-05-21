<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
   
  
    public function show($name)
{

    $user = User::where('name', $name)->firstOrFail();
    return view('user.profile', compact('user'));
}

  /*  public function follow(User $user)
{
    // Check if the authenticated user is already following the user
    $isFollowing = Auth::user()->isFollowing($user);

    if ($isFollowing) {
        // Unfollow the user
        Auth::user()->unfollow($user);
    } else {
        // Follow the user
        Auth::user()->follow($user);
    }

    return redirect()->back();
} */

public function index()
{
    $users = User::paginate(5);

    return view('user.users', compact('users')); 
}

public function delete(User $user)
{
    $user->delete();
    return redirect()->route('admin.users');
}

}