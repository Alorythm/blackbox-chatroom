<x-layout>
    <div class="terminal-auth-form">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <fieldset>
                <legend>E-mail Verification</legend>
                <p>We've sent a verification email to <strong>{{ Auth::user()->email }}</strong></p></p>
                @if(session('message'))
                    <div class="terminal-alert-primary">{{ session('message') }}</div>
                @endif
                @if(session('error'))
                    <div class="terminal-alert-error">{{ session('error') }}</div>
                @endif
                <div class="form-group">
                    <button class="btn btn-default" type="submit" role="button" name="submit" id="submit">Resend</button>
                </div>
            </fieldset>
        </form>
    </div>
</x-layout>
