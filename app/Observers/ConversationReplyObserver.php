<?php

namespace App\Observers;

use App\Models\Conversation;

class ConversationReplyObserver
{
    public function created(Conversation $conversation)
    {
        if ($conversation->isReply()) {
            return $conversation->parent->updatelastReply();
        }

        return $conversation->updatelastReply();
    }

    public function updated(Conversation $conversation)
    {
        //
    }
}