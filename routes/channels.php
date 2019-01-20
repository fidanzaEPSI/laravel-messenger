<?php

use App\Models\User;
use App\Models\Conversation;

Broadcast::channel('user.{id}', function (User $user, $id) {
     return (int) $user->id === (int) $id;
});

Broadcast::channel('conversation.{id}', function (User $user, $conversationId) {
    return $user->isInConversation(Conversation::find($conversationId));
});