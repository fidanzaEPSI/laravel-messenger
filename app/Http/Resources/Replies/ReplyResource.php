<?php

namespace App\Http\Resources\Replies;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\Resource;

class ReplyResource extends Resource
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
            'parent_id' => $this->parent_id,
            'body' => $this->body,
            'created_at' => $this->created_at->diffForHumans(),
            'user' => new UserResource($this->user),
        ];
    }
}
