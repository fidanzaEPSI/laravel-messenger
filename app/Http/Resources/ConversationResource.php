<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\Resource;

class ConversationResource extends Resource
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
            'parent_id' => $this->has('parent') ? $this->parent_id : null,
            'body' => $this->body,
            'created_at' => $this->created_at->diffForHumans(),
            'last_reply' => $this->last_reply ? $this->last_reply->diffForHumans() : null,
            'participants_count' => $this->usersExceptCurrentlyAuthenticated->count(),
            'replies' => $this->replies->map(function ($item) {
                return new UserResource($item->user);
            }),
            'user' => new UserResource($this->user),
            'users' => UserResource::collection($this->users),
            'parent' => $this->parent,
        ];
    }
}
