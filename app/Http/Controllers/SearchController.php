<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\User;
use App\Models\Post;

class SearchController extends Controller
{
    public function search(Request $request)
{
    $query = $request->input('query');

    $users = User::where('name', 'LIKE', "%$query%")->get();
    $forums = Forum::where('name', 'LIKE', "%$query%")->get();
    $posts = Post::where('content', 'LIKE', "%$query%")->get();

    return view('search.results', compact('users', 'forums', 'posts'));
}
}
