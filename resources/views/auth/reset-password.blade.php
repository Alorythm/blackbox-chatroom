<x-layout>
    <div class="terminal-auth-form">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <fieldset>
                <legend>Reset Password</legend>
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" readonly value="{{ old('email', $request->email) }}">
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
                    <button class="btn btn-default" type="submit" role="button" name="submit" id="submit">Submit</button>
                </div>
            </fieldset>
        </form>
    </div>
</x-layout>
