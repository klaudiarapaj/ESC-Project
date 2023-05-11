<?php

namespace App\Http\Controllers;


use App\Models\User;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     *  @return \Illuminate\Http\Response
     */
  /*  public function index()
    {
        return view('home');
    } */

    public function index()
    {
        $user = User::find(auth()->id());
        $feed = $user->feed();

        return view('home', [
            'user' => $user,
            'feed' => $feed,
        ]);
    }
}
