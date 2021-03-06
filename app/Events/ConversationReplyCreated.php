<?php

namespace App\Events;

use App\Models\Conversation;
use Illuminate\Broadcasting\Channel;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use App\Http\Resources\ConversationResource;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Http\Resources\Broadcast\BroadcastParentResource;
use App\Http\Resources\Broadcast\BroadcastConversationResource;

class ConversationReplyCreated implements ShouldBroadcast
{
    use InteractsWithSockets;

    public $conversation;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Conversation $conversation)
    {
        $this->conversation = $conversation;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        $channels = [
            new PrivateChannel('conversation.' . $this->conversation->parent->id),
        ];

        $this->conversation->parent->usersExceptCurrentlyAuthenticated->each(function ($user) use (&$channels) {
            $channels[] = new PrivateChannel('user.' . $user->id);
        });

        return $channels;
    }
    public function broadcastWith()
    {
        $data = array_merge((new BroadcastConversationResource($this->conversation))->resolve(), [
            'parent' => (new BroadcastParentResource($this->conversation->parent))->resolve(),
        ]);
        
        return $data;
    }
}
