<x-layout>
    @guest
    <div class="terminal-card terminal-card-welcome">
        <header>#Welcome</header>
        <div>
            Hey. Welcome wanderer.
            This place was built for those moments when you just want to write — about anything, or nothing at all.
            There’s no main topic, and that’s kind of the point.
            You’ll find the rules elsewhere, but in here, the vibe is simple: respect each other and keep it real.
            Start a thought, reply to one, or just sit back and scroll.
            No pressure, no expectations. Just a shared space with open prompts.
            Glad you’re here.
            <br>
            <br>
            ** All messages are encrypted and stored on our server. **
        </div>
    </div>
    @endguest
    @auth
    <livewire:chat />
    @endauth
</x-layout>
