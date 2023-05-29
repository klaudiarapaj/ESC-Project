<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

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

        $user = auth()->user();
        // Create notification for the user being commented on
        if ($post->user_id !== $user->id) {
            Notification::create([
                'type' => 'comment',
                'notifiable_type' => User::class,
                'notifiable_id' => $post->user_id,
                'data' => json_encode([
                    'commented_by' => $user->name,
                    'post_id' => $post->id,
                ]),
            ]);
        }

        return redirect()->back();
    }

}