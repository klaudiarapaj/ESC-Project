<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;


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
        return redirect()->back()->with('success', 'You liked this post.');
    }
}

}

