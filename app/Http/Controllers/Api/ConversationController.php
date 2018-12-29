<?php

namespace App\Http\Controllers\Api;

use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConversationResource;
use App\Http\Requests\StoreConversationRequest;

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
    public function show(Request $request, Conversation $conversation) 
    {
        $this->authorize('show', $conversation);

        if ($conversation->isReply()) {
            abort(404);
        }

        return new ConversationResource($conversation);
    }

    /**
     * Stores a new conversation and associates the given participants with it
     */
    public function store(StoreConversationRequest $request)
    {
        $conversation = (new Conversation)->fill(['body' => $request->body])->user()->associate($request->user());
        $conversation->save();

        $conversation->users()->sync(
            /** Removes any possible duplicate key and merges the request's sent user ids and the currently authenticated's user id into a new array */
            array_unique(array_merge($request->recipients, [$request->user()->id]))
        );

        return new ConversationResource($conversation);
    }
}
    