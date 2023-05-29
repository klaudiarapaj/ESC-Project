<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
   protected $fillable = [
        'title',
        'content',
        'forum_id',
    ];
  
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function reports()
{
    return $this->hasMany(Report::class);
}

public function bookmarkedBy()
{
    return $this->belongsToMany(User::class, 'bookmarks')->withTimestamps();
}

public function comments()
{
    return $this->hasMany(Comment::class);
}

public function users()
{
    return $this->belongsToMany(User::class, 'bookmarks', 'post_id', 'user_id')->withTimestamps();
}


}
