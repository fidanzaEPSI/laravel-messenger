<?php

namespace App\Policies;

use App\Models\{User, Conversation};
use Illuminate\Auth\Access\HandlesAuthorization;

class ConversationPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Conversation $conversation)
    {
        return $this->update($user, $conversation);
    }

    public function reply(User $user, Conversation $conversation)
    {
        return $this->update($user, $conversation);
    }

    public function update(User $user, Conversation $conversation)
    {
        return $user->isInConversation($conversation);
    }
}
