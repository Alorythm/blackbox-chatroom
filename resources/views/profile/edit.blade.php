<x-layout>
    @if(session('success'))
        <div class="terminal-alert">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="terminal-alert terminal-alert-error">{{ session('error') }}</div>
    @endif
    <div class="terminal-auth-form">
        <form method="POST" action="{{ route('profile.update', ['id' => $user->id]) }}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <fieldset>
                <legend>Update</legend>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input id="username" name="name" type="text" value="{{ $user->name }}">
                    @error('name')
                        <div class="terminal-alert-error mt-5">{{ $message }}</div>
                    @enderror
                </div>
                @if(Auth::id() || Auth::user()->is_admin)
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input id="email" name="email" type="email" value="{{ $user->email }}">
                        @error('email')
                            <div class="terminal-alert-error mt-5">{{ $message }}</div>
                        @enderror
                    </div>
                @endif
                <div class="form-group">
                    <input type="file" id="image" name="image">
                    @error('image')
                        <div class="terminal-alert-error mt-5">{{ $message }}</div>
                    @enderror
                </div>
                @if(Auth::user()->is_admin && Auth::id() !== $user->id)
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select id="role" name="role">
                        <option selected disabled>Select a role</option>
                        <option value="administrator">Administrator</option>
                        <option value="moderator">Moderator</option>
                        <option value="user">User</option>
                    </select>
                    @error('role')
                        <div class="terminal-alert-error mt-5">{{ $message }}</div>
                    @enderror
                </div>
                @endif
                @if(Auth::user()->is_admin && Auth::id() !== $user->id)
                <div class="form-group">
                    <label for="status">Status:</label>
                    @if($user->isBanned())
                        <input name="status" type="checkbox" id="status" checked>(Banned)</input>
                    @else
                        <input name="status" type="checkbox" id="status">(Banned)</input>
                    @endif
                    @error('status')
                        <div class="terminal-alert-error mt-5">{{ $message }}</div>
                    @enderror
                </div>
                @endif
                <div class="form-group">
                    <button class="btn btn-default" type="submit" role="button" name="submit" id="submit">Submit</button>
                </div>
            </fieldset>
        </form>
    </div>
</x-layout>
