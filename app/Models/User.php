<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function searchableAs()
    {
        return 'users_index';
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class)
            ->whereNull('parent_id')
            ->orderBy('last_reply', 'desc');
    }

    public function isInConversation(Conversation $conversation)
    {
        return $this->conversations->contains($conversation);
    }

    public function avatar($size = 45)
    {
        return 'https://www.gravatar.com/avatar/' . md5($this->email) . 'x?s=' . $size . '&default=mp';
    }
}
