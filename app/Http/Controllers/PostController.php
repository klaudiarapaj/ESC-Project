<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;




class PostController extends Controller
{
    public function create(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'tags.*' => 'nullable|max:255',
        'tags' => 'array|max:5',

    ]);

    $tags = isset($validatedData['tags']) ? array_filter($validatedData['tags']) : null;



   
    // Create the new post using the authenticated user
    $user = User::find(auth()->id());
    $post = $user->posts()->create([
        'title' => $validatedData['title'],
        'content' => $validatedData['content'],
        'tags' => $tags,
        'forum_id' => $request->input('forum_id'),
    ]);

    // Redirect to the post's page
    return redirect()->route('post.show', ['post' => $post]);
}
    

    public function show(Post $post)
    {
        
        return view('post.show', [
            'post' => $post,
        ]);
    }

   

    public function showuser($user)
{
    $user = User::where('name', $user)->firstOrFail();
    return view('profile.show', compact('user'));
}



    
}
