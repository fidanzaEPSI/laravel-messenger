<?php

namespace App\Http\Controllers\Api;

use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\ConversationUsersCreated;
use App\Http\Resources\ConversationResource;
use App\Http\Requests\StoreConversationUserRequest;

class ConversationUserController extends Controller
{
    public function store(StoreConversationUserRequest $request, Conversation $conversation)
    {
        $this->authorize('update', $conversation);

        $conversation->users()->syncWithoutDetaching($request->recipients);

        broadcast(new ConversationUsersCreated($conversation))->toOthers();

        return new ConversationResource($conversation);
    }
}
