<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Report;


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
           
        ]);

        // Redirect to the post's page
        return redirect()->route('post.show', ['post' => $post]);
    }


    public function bookmark(Post $post)
    {
        auth()->user()->bookmarks()->attach($post);
    
        return redirect()->back()->with('success', 'Post bookmarked successfully!');
    }

    public function removeBookmark(Post $post)
{
    auth()->user()->bookmarks()->detach($post);

    return redirect()->back()->with('success', 'Bookmark removed successfully!');
}

    public function showBookmarks()
    {
        $posts = auth()->user()->bookmarks()->paginate(10);
    
        return view('post.bookmarks', compact('posts'));
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
            'post' => $post, 'user' => $post->user,
        ]);
    }
   

    public function deletePost(Post $post)
    {
       
        $post->delete();
        
        return redirect()->route('profile');
       
    }

    public function report(Post $post)
{
    // Create a new report in the reports table
    Report::create([
        'post_id' => $post->id,
        'user_id' => auth()->user()->id, // Assuming you're using authentication
        // Additional columns if any
    ]);
    
    return redirect()->back()->with('success', 'Post reported successfully!');
}


    //for admin

    public function showReportedPosts()
{
    $posts = Report::with('post')->whereHas('post')->paginate(5);
  // Assuming the `Report` model has a relationship with the `Post` model

    return view('post.posts', compact('posts'));
}

public function clear($id)
{
    Report::where('post_id', $id)->delete();

    return redirect()->back()->with('success', 'Reports cleared for the post.');
}


    public function delete(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts');
    }

}
