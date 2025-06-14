<div>
    <div class="terminal-card">
        <header>Welcome to the #General</header>
    </div>
    <div class="terminal-card terminal-chat">
        <div wire:poll.2s>
            @foreach($messages as $message)
                <div class="message">
                    @if($message->user->is_admin)
                    <p>
                        <span>[{{ $message->created_at->format('H:i:s') }}]</span> <img src="{{ Storage::url($message->user->image) }}" width="32" height="32" /> <strong style="background-color: #d20962;"><a href="{{ route('profile.show', ['id' => $message->user->id]) }}" class="no-deco">{{ $message->user->name }}</a></strong>: {{ $message->text }}<span>
                            @if(Auth::user()->is_admin)
                            <a wire:click="deleteMessage({{ $message->id }})">(delete)</a>
                            @endif
                        </span>
                    </p>
                    @elseif($message->user->is_moderator)
                    <p>
                        <span>[{{ $message->created_at->format('H:i:s') }}]</span> <img src="{{ Storage::url($message->user->image) }}" width="32" height="32" /> <strong style="background-color: #d2a009;"><a href="{{ route('profile.show', ['id' => $message->user->id]) }}" class="no-deco">{{ $message->user->name }}</a></strong>: {{ $message->text }}<span>
                            @if(Auth::user()->is_admin || Auth::user()->is_moderator)
                                <a wire:click="deleteMessage({{ $message->id }})">(delete)</a>
                            @endif
                        </span>
                    </p>
                    @else
                    <p>
                        <span>[{{ $message->created_at->format('H:i:s') }}]</span> <img src="{{ Storage::url($message->user->image) }}" width="32" height="32" /> <strong><a href="{{ route('profile.show', ['id' => $message->user->id]) }}">{{ $message->user->name }}</a></strong>: {{ $message->text }}<span>
                            @if(Auth::user()->is_admin || Auth::user()->is_moderator)
                            <a wire:click="deleteMessage({{ $message->id }})">(delete)</a>
                            @endif
                        </span>
                    </p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    <input class="terminal-chat-input" type="text" name="text" placeholder="Type your message here..." wire:model="message" wire:keydown.enter="sendMessage">
</div>
