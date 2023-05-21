<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminPageController extends Controller
{
    //create forums

  /*  public function makeAdmin(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = 1;
        $user->save();

        return redirect()->back()->with('success', 'User has been set as admin');
    } */
  

    public function index()
    {
        return view('admin.admin');
    }

}
