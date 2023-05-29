<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\User;
use Illuminate\Support\Facades\View;




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
        // Find the forum by name
    $forum = Forum::where('name', $name)->firstOrFail();

    // Get the authenticated user
    $user = auth()->user();

   
    // Pass the forum and user to the view
    return view('forums.show', compact('forum', 'user'));
    }
    
    

    /* public function show(Forum $forum)
    {
        $forum->load('posts.user', 'posts.likes', 'posts.comments.user');
        $canJoin = auth()->check() && !$forum->users->contains(auth()->id());

        return view('forums.show', compact('forum', 'canJoin'));
    }*/

    public function join($id)
    {
        // Get the authenticated user
        $user = auth()->user();
    
        // Find the forum by ID
        $forum = Forum::findOrFail($id);
    
        // Check if the user is already a member of the forum
        if ($user->forums->contains($forum)) {
            // User is already a member, handle it accordingly (e.g., show a message)
            return redirect()->back()->with('message', 'You are already a member of this forum.');
        }
    
        // Attach the forum to the user's forums (assuming you have a many-to-many relationship)
        $user->forums()->attach($forum);
    
        // Redirect to the forum page or any other desired location
        return redirect()->back()->with('message', 'You have joined the forum successfully.');
    }
    


    public function leave(Forum $forum)
    {
        // Get the authenticated user
        $user = auth()->user();
    
        // Detach the user from the forum's members
        $forum->members()->detach($user);

        // Redirect back to the forum or any other appropriate page
        return redirect()->route('forums.show', ['name' => $forum->name]);
        
    }
}    
