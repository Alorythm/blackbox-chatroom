<x-layout>
    <div class="terminal-auth-form">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <fieldset>
                <legend>Forgot Password</legend>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input id="email" name="email" type="email">
                    @error('email')
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
