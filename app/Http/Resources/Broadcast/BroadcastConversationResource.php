<?php

namespace App\Http\Resources\Broadcast;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\Broadcast\BroadcastUserResource;
use App\Http\Resources\Broadcast\BroadcastParentResource;

class BroadcastConversationResource extends Resource
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
            'data' => [
                'id' => $this->id,
                'parent_id' => $this->parent ? $this->parent->id : null,
                'body' => $this->body,
                'created_at' => $this->created_at->diffForHumans(),
                'last_reply' => $this->last_reply ? $this->last_reply->diffForHumans() : null,
                'participants_count' => $this->when($this->parent, $this->parent->usersExceptCurrentlyAuthenticated->count(), $this->usersExceptCurrentlyAuthenticated->count()),
                'user' => (new BroadcastUserResource($this->user))->resolve(),
                'users' => $this->when(!$this->isReply(), 
                    $this->users->map(function ($user) {
                        return (new BroadcastUserResource($user))->resolve();
                    })->toArray(),
                    $this->parent->users->map(function ($user) {
                        return (new BroadcastUserResource($user))->resolve();
                    })->toArray()
                ),
            ]
        ];
    }
}
