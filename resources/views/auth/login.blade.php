<x-layout>
    <div class="terminal-auth-form">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <fieldset>
                <legend>Login</legend>
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
                <p class="terminal-toc text-end"><a href="{{ route('password.request') }}" class="auth-link">Forgot your password?</a></p>
                <div class="form-group">
                    <button class="btn btn-default" type="submit" role="button" name="submit" id="submit">Login</button>
                </div>
            </fieldset>
        </form>
    </div>
</x-layout>
