<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\Replies\{ParentResource, ReplyResource};

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
            'parent_id' => $this->parent ? $this->parent->id : null,
            'body' => $this->body,
            'created_at' => $this->created_at->diffForHumans(),
            'last_reply' => $this->last_reply ? $this->last_reply->diffForHumans() : $this->parent->last_reply->diffForHumans(),
            'participants_count' => $this->usersExceptCurrentlyAuthenticated->count(),
            'parent' => $this->when($this->isReply(), new ParentResource($this->parent)),
            'replies' => $this->when(!$this->isReply(), ReplyResource::collection($this->replies)),
            'user' => new UserResource($this->user),
            'users' => UserResource::collection($this->isReply() ? $this->parent->users : $this->users),
        ];
    }
}
