<?php

use App\Models\User;
use App\Models\Conversation;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('user.*', function (User $user, $userId) {
    return (int) $user->id === (int) $userId;
});

Broadcast::channel('conversation.*', function (User $user, $conversationId) {
    return $user->isInConversation(Conversation::find($conversationId));
});