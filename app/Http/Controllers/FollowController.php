<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function store(User $user)
    {
        auth()->user()->following()->attach($user->id);

        // Create notification
        $notification = Notification::create([
            'type' => 'follow',
            'notifiable_type' => User::class,
            'notifiable_id' => $user->id,
            'data' => json_encode([
                'follower_name' => Auth::user()->name,
            ]),
        ]);

        return redirect()->back()->with('success', 'You are now following ' . $user->name);
    }

    public function destroy(User $user)
    {
        auth()->user()->following()->detach($user->id);

        return redirect()->back()->with('success', 'You have unfollowed ' . $user->name);
    }
}
