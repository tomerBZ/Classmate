<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property mixed $friends
 * @property mixed $posts
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','class', 'birthday'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Posts::class);
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'users_friends', 'user_id', 'friend_id')
            ->wherePivot('accepted', '=', 1);
    }


    public function unapprovedFriends()
    {
        return $this->belongsToMany(User::class, 'users_friends', 'user_id', 'friend_id')
            ->wherePivot('accepted', '=', 0);
    }

    public function friendRequests()
    {
        return $this->belongsToMany($this, 'users_friends', 'friend_id', 'user_id')
            ->wherePivot('accepted', '=', 0);
    }

    public function myFriendRequests()
    {
        return $this->belongsToMany($this, 'users_friends', 'user_id', 'friend_id')
            ->wherePivot('accepted', '=', 0);
    }

    public function addFriend($id)
    {
        $this->friends()->attach($id);
    }

    public function approveFriendRequest()
    {
        $this->friends()->attach(['accepted' => true]);
    }

    public function addAndApproveFriendRequest($id)
    {
        $this->friends()->attach($id, ['accepted' => true]);
    }

    public function removeFriend($id)
    {
        $this->belongsToMany(User::class, 'users_friends', 'user_id', $id)->detach();
    }
}
