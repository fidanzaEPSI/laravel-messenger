<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $dates = ['last_reply'];

    protected $fillable = ['body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongstoMany(User::class);
    }

    public function usersExceptCurrentlyAuthenticated()
    {
        return $this->users()->where('user_id', '!=', Auth::user()->id);
    }

    public function replies() 
    {
        // return $this->hasMany(Conversation::class, 'parent_id')->latestFirst();
        return $this->hasMany(Conversation::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Conversation::class, 'parent_id');
    }

    public function updatelastReply()
    {
        return $this->setAttribute('last_reply', \Carbon\Carbon::now())->save();
    }

    public function isReply() 
    {
        return $this->parent_id != null;
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

}
