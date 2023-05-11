<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user(); // Retrieve the authenticated user
       
        // Pass the user data to the view
        return view('profile', [
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request)
    {
     //  $user = Auth::user(); // Get the authenticated user
     $user = User::find(auth()->id());
        $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'birthdate' => 'nullable|date',
            'interests' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:255',
            'major' => 'nullable|string|max:255',
            'phonenumber' => 'nullable|string|max:255',
        ]);

        // Update the user's information with the form data
        $user->department = $request->input('department');
        $user->birthdate = $request->input('birthdate');
        $user->interests = $request->input('interests');
        $user->bio = $request->input('bio');
        $user->major = $request->input('major');
        $user->phonenumber = $request->input('phonenumber');
        
        // Save the changes to the database
        $user->save();
        
        // Redirect the user to their profile page with a success message
        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    public function editProfile()
    {
        $user = Auth::user(); // Get the authenticated user

        // Pass the user data to the view
        return view('editProfile', [
            'user' => $user
        ]);
    }

    public function updateProfileForm()
    {
        $user = Auth::user(); // Get the authenticated user

        // Pass the user data to the view
        return view('updateProfileForm', [
            'user' => $user
        ]);
    }
}
