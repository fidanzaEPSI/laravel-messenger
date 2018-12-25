<?php

namespace App\Observers;

use App\Models\Conversation;

class ConversationReplyObserver
{
    public function created(Conversation $conversation)
    {
        $conversation->touchLastReply();
    }

    public function updated(Conversation $conversation)
    {
        //
    }
}