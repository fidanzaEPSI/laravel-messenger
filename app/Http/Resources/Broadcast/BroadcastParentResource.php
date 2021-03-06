<?php

namespace App\Http\Resources\Broadcast;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\Broadcast\BroadcastUserResource;

class BroadcastParentResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'created_at' => $this->created_at->diffForHumans(),
            'last_reply' => $this->last_reply ? $this->last_reply->diffForHumans() : null,
            'participants_count' => $this->usersExceptCurrentlyAuthenticated->count(),
            'user' => (new BroadcastUserResource($this->user))->resolve(),
            'users' => $this->users->map(function ($user) {
                return (new BroadcastUserResource($user))->resolve();
            })->toArray(),
            
        ];
    }
}
