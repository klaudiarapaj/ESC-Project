<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminPageController extends Controller
{

    public function index()
    {
        return view('admin.admin');
    }

}
