<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
{
    protected $avatarSize;

    public function __construct($userResource, int $avatarSize)
    {
        parent::__construct($userResource);
        $this->avatarSize = $avatarSize;
    }

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
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => $this->avatar($this->avatarSize),
            'created_at' => $this->created_at->diffForHumans(now()),
            'updated_at' => $this->updated_at->diffForHumans(now()),
        ];
    }
}
