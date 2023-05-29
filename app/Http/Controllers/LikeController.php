<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use App\Models\Notification;


class LikeController extends Controller
{
    public function like(Post $post)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->likes()->where('post_id', $post->id)->exists()) {
            $user->likes()->where('post_id', $post->id)->delete();
            return redirect()->back()->with('success', 'You unliked this post.');
        } else {
            $user->likes()->create(['post_id' => $post->id]);
            // Creating a notification
            if ($post->user_id !== $user->id) {
                Notification::create([
                    'type' => 'like',
                    'notifiable_type' => User::class,
                    'notifiable_id' => $post->user_id,
                    'data' => json_encode([
                        'liked_by' => $user->name,
                        'post_id' => $post->id,
                    ]),
                ]);
            }
            return redirect()->back()->with('success', 'You liked this post.');
        }
    }
}
