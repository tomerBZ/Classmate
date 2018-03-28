<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property mixed $user
 * @property mixed $users
 */
class Posts extends Model
{
    protected $fillable = [
        'user_id', 'title', 'content'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'posts', 'id', 'user_id');
    }
}
