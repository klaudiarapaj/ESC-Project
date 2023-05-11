<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\User;
use Auth;



class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::all();

        return view('forums.index', compact('forums'));
    }

    public function show(Forum $forum)
    {
        $forum->load('posts.user', 'posts.likes', 'posts.comments.user');
        $canJoin = auth()->check() && !$forum->users->contains(auth()->id());
       
        return view('forums.show', compact('forum', 'canJoin'));
    }
    
    public function join(Forum $forum)
    {
        $user = User::find(auth()->id());
        $user->forumsJoined()->attach($forum);
        $forum->user_joined++;
        $forum->save();

        return redirect()->route('forums.show', ['forum' => $forum]);
    }
    
    public function leave(Forum $forum)
    {
        $user = User::find(auth()->id());
        $user->forumsJoined()->detach($forum);
        $forum->user_joined--;
        $forum->save();

        return redirect()->route('forums.show', ['forum' => $forum]);
    }


}