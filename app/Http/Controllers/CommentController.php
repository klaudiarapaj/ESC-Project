<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function create(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = auth()->user()->id;

        $post->comments()->save($comment);

        return redirect()->back();
    }

    public function store(Request $request)
    {
        // Validate the comment data
        $validatedData = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string|max:255',
        ]);
    
        // Create the comment
        $comment = new Comment();
        $comment->post_id = $validatedData['post_id'];
        $comment->user_id = auth()->user()->id;
        $comment->content = $validatedData['content'];
        $comment->save();
    
        return redirect()->back()->with('success', 'Comment added successfully!');
    }
}