<?php

namespace App\Observers;

use App\Models\Conversation;

class ConversationReplyObserver
{
    public function created(Conversation $conversation)
    {
        $conversation->updatelastReply();
    }

    public function updated(Conversation $conversation)
    {
        //
    }
}