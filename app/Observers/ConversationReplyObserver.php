<?php

namespace App\Observers;

use App\Models\Conversation;

class ConversationReplyObserver
{
    public function created(Conversation $conversation)
    {
        info('created' . $conversation->id); 
        $conversation->touchLastReply();
    }

    public function updated(Conversation $conversation)
    {
        //
    }
}