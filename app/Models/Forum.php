<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_joined',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'forum_user', 'forum_id', 'user_id')->withTimestamps();
    }

    public function incrementUserJoinedCount()
    {
        $this->user_joined++;
        $this->save();
    }
}

