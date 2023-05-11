<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Like;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory;
    use Notifiable;

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

    public function joinMajors()
    {
        return $this->belongsToMany(Major::class, 'major_user', 'user_id', 'major_id');
    }

     // Define the "following" relationship
     public function following()
     {
         return $this->belongsToMany(User::class, 'followers', 'follower_id', 'following_id')->withTimestamps();
     }
 
     // Define the "followers" relationship
     public function followers()
     {
         return $this->belongsToMany(User::class, 'followers', 'following_id', 'follower_id')->withTimestamps();
     }

      // Define the "forums joined" relationship
    public function forumsJoined()
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
