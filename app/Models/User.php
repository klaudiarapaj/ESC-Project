<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use Spatie\Permission\Traits\HasRoles;




class User extends Authenticatable
{
    use HasApiTokens, HasFactory;
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'department',
        'birthdate',
        'interests',
        'bio',
        'major',
        'phonenumber',
        'profile_picture',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'likes');
    }

  

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
    }
    
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }
    
    public function isFollowing($userId)
    {
        return $this->following->contains($userId);
    }
    

    public function bookmarks()
    {
        return $this->belongsToMany(Post::class, 'bookmarks', 'user_id', 'post_id')->withTimestamps();
    }


    // Define the "forums joined" relationship
    public function forums()
    {
        return $this->belongsToMany(Forum::class, 'forum_user', 'user_id', 'forum_id')->withTimestamps();
    }

    public function feed()
    {
        // Get the IDs of the users that the current user is following, including their own ID
        $followingIds = $this->following()->pluck('users.id')->push($this->id);



        // Get the IDs of the forums that the current user has joined
        $forumIds = $this->forumsJoined()->pluck('forums.id');

        // Get the posts from the users that the current user is following, as well as their own posts, and the posts from the forums they have joined
        return Post::whereIn('user_id', $followingIds)
            ->orWhereIn('forum_id', $forumIds)
            ->orWhere('user_id', $this->id)
            ->orderByDesc('created_at')
            ->get();
    }


    public function comments()
{
    return $this->hasMany(Comment::class);
}


    public function profilefeed(){
        return $this->hasMany(Post::class)->orderByDesc('created_at');
    }

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function isAdmin()
{
    return $this->role === 'admin';
}

public function notifications()
{
    return $this->morphMany(Notification::class, 'notifiable')
        ->orderBy('created_at', 'desc');
}

public function forumsJoined(){
    return $this->belongsToMany(Forum::class, 'forum_user', 'user_id', 'forum_id')->withTimestamps();
}




    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
