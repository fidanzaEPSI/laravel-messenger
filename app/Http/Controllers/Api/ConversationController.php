<?php

namespace App\Http\Controllers\Api;

use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConversationResource;

class ConversationController extends Controller
{
    /**
     * Returns the currently authenticated user's conversations.
     */
    public function index(Request $request)
    {
        return ConversationResource::collection($request->user()->conversations);
    }

    /**
     * Returns a conversation by it's identifier (id)
     */
    public function show(Conversation $conversation) {
        return new ConversationResource($conversation);
    }
}
    