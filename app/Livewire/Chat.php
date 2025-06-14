<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Chat extends Component
{
    public $message;

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|string|min:1|max:2000',
        ]);

        Message::create([
            'user_id' => Auth::id(),
            'text' => Crypt::encryptString($this->message),
        ]);

        $this->message = '';
    }

    public function deleteMessage($messageId)
    {
        $message = Message::find($messageId);

        if(Auth::user()->is_admin || Auth::user()->is_moderator) {
            $message->delete();
        }

    }

    public function render()
    {
        $messages = Message::orderBy('created_at', 'desc')->take(500)->get();
        
        foreach ($messages as $message) {
            $message->text = Crypt::decryptString($message->text);
        }

        return view('livewire.chat', compact('messages'));
    }
}
