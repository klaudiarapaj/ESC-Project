<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\User;




class ForumController extends Controller
{

    //for the admin 
    public function index()
    {
        $forums = Forum::paginate(5);

        return view('forums.forums', compact('forums'));
    }


    public function create()
    {
        return view('forums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:forums',
            'description' => 'required|max:1000',
        ]);


        $forum = new Forum();
        $forum->name = $request->name;
        $forum->description = $request->description;
        $forum->save();

        return redirect()->route('admin.forums', ['forum' => $forum]);
    }

    public function edit(Forum $forum)
    {
        return view('forums.edit', compact('forum'));
    }

    public function update(Request $request, Forum $forum)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:1000',
        ]);

        $forum->name = $request->name;
        $forum->description = $request->description;
        $forum->save();

        return redirect()->route('admin.forums', ['forum' => $forum]);
    }


    public function delete(Forum $forum)
    {
        $forum->delete();

        return redirect()->route('admin.forums');
    }


    //for the user
    

    public function show($name)
    {
        $forum = Forum::where('name', $name)->firstOrFail();
        
        // Retrieve the forum with its members and posts
        $forum->load('members', 'posts');
        
        return view('forums.show', compact('forum'));
    }
    
    

    /* public function show(Forum $forum)
    {
        $forum->load('posts.user', 'posts.likes', 'posts.comments.user');
        $canJoin = auth()->check() && !$forum->users->contains(auth()->id());

        return view('forums.show', compact('forum', 'canJoin'));
    }*/

    public function join($name)
{

    $forum = Forum::where('name', $name)->firstOrFail();
    // Retrieve the forum based on the ID or name
    
    
    // Implement your logic for joining the forum
    // For example, you can add the authenticated user as a member of the forum
    $user = auth()->user();
    $forum->members()->attach($user);
    
    // Redirect the user to the forum's page or display a success message
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
