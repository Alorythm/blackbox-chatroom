<x-layout>
    @if(session('success'))
        <div class="terminal-alert">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="terminal-alert terminal-alert-error">{{ session('error') }}</div>
    @endif
    <div class="termina-photo-container">
        <figure>
            @if($user->image)
                <img src="{{ Storage::url($user->image) }}" height="200" width="200" alt="Profile picture">
            @endif
        </figure>
    </div>
    <div class="terminal-profile-info">
        <ul>
            <li>#ID: {{ $user->id }}</li>
            <li>Username: {{ $user->name }}</li>
            @if(Auth::id() === $user->id)
                <li>E-mail: {{ $user->email }}</li>
            @endif
            @if($user->is_admin)
                <li>Role: Administrator</li>
            @elseif($user->is_moderator)
                <li>Role: Moderator</li>
            @endif
            <li>Registration: {{ $user->created_at }}</li>
            <li>(total) Messages: {{ $user->messages->count() }}</li>
        </ul>
        @if(Auth::id() === $user->id || Auth::user()->is_admin || Auth::user()->is_moderator)
        <div class="terminal-btn-group max-40">
            <a href="{{ route('profile.edit', ['id' => $user->id]) }}" class="btn btn-default" type="submit">Edit</a>
        </div>
        @endif
    </div>
</x-layout>
