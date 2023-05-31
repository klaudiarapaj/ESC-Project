<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class ProfileController extends Controller
{
   

   public function show()
   {
       $userId = auth()->user()->id;
       $user = User::findOrFail($userId);
       $feed = $user->profilefeed;
   
       return view('profile.profile', compact('user', 'feed'));
   }

   

    public function update(Request $request)
    {
     
     $user = User::find(auth()->id());


        $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'birthdate' => 'nullable|date',
            'interests' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:255',
            'major' => 'nullable|string|max:255',
            'phonenumber' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update the user's information with the form data
        $user->name = $request->input('name');
        $user->department = $request->input('department');
        $user->birthdate = $request->input('birthdate');
        $user->interests = $request->input('interests');
        $user->bio = $request->input('bio');
        $user->major = $request->input('major');
        $user->phonenumber = $request->input('phonenumber');
        
        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images', $filename, 'public');
            $user = Auth::user();
            $user->profile_picture = $filename;
        }
        
        
        // Save the changes to the database
        $user->save();
        
        // Redirect the user to their profile page with a success message
        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }


}
