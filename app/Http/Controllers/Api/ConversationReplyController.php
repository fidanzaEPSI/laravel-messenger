<?php

namespace App\Http\Controllers\Api;

use App\Models\Conversation;
use App\Http\Controllers\Controller;
use App\Events\ConversationReplyCreated;
use App\Http\Resources\ConversationResource;
use App\Http\Requests\StoreConversationReplyRequest;

class ConversationReplyController extends Controller
{
    public function store(StoreConversationReplyRequest $request, Conversation $conversation)
    {
        $this->authorize('reply', $conversation);

        $reply = (new Conversation)->fill([
            'body' => $request->body,
        ])->user()->associate($request->user());

        $conversation->replies()->save($reply);

        broadcast(new ConversationReplyCreated($reply))->toOthers();
        
        return new ConversationResource($reply);
    }
}
