<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Notification extends Model
{
    protected $guarded = [];

    /**
     * Get the notifiable model.
     */
    public function notifiable()
    {
        return $this->morphTo();
    }

    /**
     * Get the URL related to the notification.
     *
     * @return string|null
     */
    public function getUrlAttribute()
    {
        $data = json_decode($this->data, true);
    
        if ($this->type === 'like') {
            return route('post.show', ['post' => $data['post_id']]);
        } elseif ($this->type === 'follow') {
            $notifiableUser = User::where('name', $data['follower_name'])->first();
        if ($notifiableUser) {
            return route('user.profile', ['user' => $notifiableUser->name]);
        }}elseif ($this->type === 'comment') {
            return route('post.show', ['post' => $data['post_id']]);
        }
    
        return '#';
    }
    

    /**
     * Get the message for the notification.
     *
     * @return string|null
     */
    public function getMessageAttribute()
{
    $data = json_decode($this->data, true);

    if ($this->type === 'like' && isset($data['liked_by'])) {
        return $data['liked_by'] . ' liked your post.';
    } elseif ($this->type === 'follow' && isset($data['follower_name'])) {
        return $data['follower_name'] . ' started following you.';
    }elseif ($this->type === 'comment' && isset($data['commented_by'])) {
        return $data['commented_by'] . ' commented on your post.';
    }

    return null;
}

}

