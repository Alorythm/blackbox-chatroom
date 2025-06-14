<x-layout>
    <div class="terminal-auth-form">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <fieldset>
                <legend>Register</legend>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input id="username" name="name" type="text">
                    @error('name')
                        <div class="terminal-alert-error mt-5">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input id="email" name="email" type="email">
                    @error('email')
                        <div class="terminal-alert-error mt-5">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                    @error('password')
                        <div class="terminal-alert-error mt-5">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirmation">Confirm Password:</label>
                    <input type="password" id="password-confirmation" name="password_confirmation">
                    @error('password_confirmation')
                        <div class="terminal-alert-error mt-5">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-default" type="submit" role="button" name="submit" id="submit">Register</button>
                </div>
            </fieldset>
        </form>
    </div>
</x-layout>
