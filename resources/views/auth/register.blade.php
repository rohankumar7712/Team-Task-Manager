<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h2 style="text-align: center; margin-bottom: 2rem;">Create Account</h2>

        <div class="form-group">
            <label for="name">Full Name</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            @error('name') <span style="color: var(--accent-rose); font-size: 0.8rem;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
            @error('email') <span style="color: var(--accent-rose); font-size: 0.8rem;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" />
            @error('password') <span style="color: var(--accent-rose); font-size: 0.8rem;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>

        <div style="display: flex; flex-direction: column; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn-primary" style="border: none; cursor: pointer; width: 100%;">Get Started</button>
            
            <p style="text-align: center; font-size: 0.9rem; color: var(--text-muted);">
                Already have an account? <a href="{{ route('login') }}" style="color: var(--primary); text-decoration: none;">Sign In</a>
            </p>
        </div>
    </form>
</x-guest-layout>
