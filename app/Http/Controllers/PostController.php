<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;




class PostController extends Controller
{

    //for regular posts
    public function create(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        

        // Create the new post using the authenticated user
        $user = User::find(auth()->id());
        $post = $user->posts()->create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'forum_id' => $request->input('forum_id'),
        ]);

        // Redirect to the post's page
        return redirect()->route('post.show', ['post' => $post]);
    }






    //for forum posts
   public function store(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'forum_id' => 'required|exists:forums,id',
    ]);

 

    // Get the authenticated user
    $user = auth()->user();

    // Check if the authenticated user exists
    if (!$user) {
        // Handle the case where the authenticated user doesn't exist
        return redirect()->back()->withErrors(['error' => 'User not found']);
    }

    // Create the new post using the authenticated user's ID
    $post = $user->posts()->create([
        'title' => $validatedData['title'],
        'content' => $validatedData['content'],
        'forum_id' => $validatedData['forum_id'],
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


    //for admin

    public function index()
    {

        $posts = Post::paginate(5);
        return view('post.posts', compact('posts'));
    }

    public function delete(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts');
    }

}
