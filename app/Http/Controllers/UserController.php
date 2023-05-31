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
        $feed = $user->posts()->latest()->get();
        return view('user.profile', compact('user', 'feed'));
    }


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

    public function updateRole(Request $request, User $user)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'role' => 'required|in:admin,user',
        ]);

        // Update the user's role
        $user->role = $validatedData['role'];
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'User role updated successfully.');
    }
}
